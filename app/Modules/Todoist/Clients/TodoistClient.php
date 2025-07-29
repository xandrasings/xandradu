<?php

namespace App\Modules\Todoist\Clients;

use App\Models\TodoistAccount;
use App\Models\TodoistProject;
use App\Models\TodoistSection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class TodoistClient
{
    private string $hostName;

    private string $userEndpoint;

    private string $syncEndpoint;

    private string $sectionsEndpoint;

    private string $projectsEndpoint;

    public function __construct()
    {
        $this->hostName = config('services.todoist.host_name');
        $this->userEndpoint = config('services.todoist.user_endpoint');
        $this->syncEndpoint = config('services.todoist.sync_endpoint');
        $this->sectionsEndpoint = config('services.todoist.sections_endpoint');
        $this->projectsEndpoint = config('services.todoist.projects_endpoint');
    }

    public function getUser(string $token): ?array
    {
        $url = "{$this->hostName}{$this->userEndpoint}";

        try {
            Log::notice("Calling todoist endpoint $url.");
            $response = Http::withToken($token)
                ->get($url);
        } catch (Throwable $exception) {
            Log::warning("Call to todoist endpoint $url failed with exception {$exception->getMessage()}");
            return null;
        }

        if ($response->failed()) {
            Log::warning("Call to todoist endpoint $url failed with response {$response->getStatusCode()}");
            return null;
        }

        return $response->json();
    }

    public function getProjectUsers(TodoistProject $project, TodoistAccount $account): ?Collection
    {
        $url = "{$this->hostName}{$this->projectsEndpoint}/{$project->external_id}/collaborators";
        $token = Crypt::decryptString($account->access_token);

        try {
            Log::notice("Calling todoist endpoint $url.");
            $response = Http::withToken($token)
                ->get($url);
        } catch (Throwable $exception) {
            Log::warning("Call to todoist endpoint $url failed with exception {$exception->getMessage()}.");
            return null;
        }

        if ($response->failed()) {
            Log::warning("Call to todoist endpoint $url failed with response {$response->getStatusCode()}.");
            return null;
        }

        // TODO cursor logic

        $projectUsersPayload = data_get($response->json(),'results');

        if (is_null($projectUsersPayload)) {
            Log::warning("getProjectUsers failed due to lack of result in response.");
            return null;
        }

        return collect($projectUsersPayload);
    }

    public function getLatestChanges(TodoistAccount $account): ?array
    {
        $url = "{$this->hostName}{$this->syncEndpoint}";
        $token = Crypt::decryptString($account->access_token);

        // TODO store and use sync token where appropriate

        try {
            Log::notice("Calling todoist endpoint $url.");
            $response = Http::withToken($token)
                ->get($url, [
                    'sync_token'=>'*',
                    'resource_types'=>'["projects","sections"]' // TODO generate this better
                ]);
        } catch (Throwable $exception) {
            Log::warning("Call to todoist endpoint $url failed with exception {$exception->getMessage()}");
            return null;
        }

        if ($response->failed()) {
            Log::warning("Call to todoist endpoint $url failed with response {$response->getStatusCode()}");
            return null;
        }

        return $response->json();
    }

    public function createSection(TodoistAccount $account, TodoistSection $section): ?array
    {

        $url = "{$this->hostName}{$this->sectionsEndpoint}";
        $token = Crypt::decryptString($account->access_token);
        $body = [
            'name'=>$section->name,
            'project_id'=>$section->project->external_id
        ];

        try {
            Log::notice("Calling todoist endpoint $url.", ['body'=>$body]);
            $response = Http::withToken($token)
                ->post($url, $body);
        } catch (Throwable $exception) {
            Log::warning("Call to todoist endpoint $url failed with exception {$exception->getMessage()}");
            return null;
        }

        if ($response->failed()) {
            Log::warning("Call to todoist endpoint $url failed with response {$response->getStatusCode()}");
            return null;
        }

        return $response->json();
    }
}
