<?php

namespace App\Modules\Todoist\Clients;

use App\Models\TodoistAccount;
use App\Models\TodoistProject;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class TodoistClient
{
    private string $hostName;

    private string $userEndpoint;

    private string $syncEndpoint;

    private string $projectEndpoint;

    public function __construct()
    {
        $this->hostName = config('services.todoist.host_name');
        $this->userEndpoint = config('services.todoist.user_endpoint');
        $this->syncEndpoint = config('services.todoist.sync_endpoint');
        $this->projectEndpoint = config('services.todoist.project_endpoint');
    }

    public function getUser(string $token): ?array
    {
        $url = "{$this->hostName}{$this->userEndpoint}";

        try {
            Log::notice("Calling todoist endpoint $url.");
            $response = Http::withToken($token)
                ->get($url);
        } catch (Throwable $exception) {
            Log::error("Call to todoist endpoint $url failed with exception {$exception->getMessage()}");
            return null;
        }

        if ($response->failed()) {
            Log::error("Call to todoist endpoint $url failed with response {$response->getStatusCode()}");
            return null;
        }

        return $response->json();
    }

    public function getProjectUsers(TodoistProject $project, TodoistAccount $account): ?array
    {
        $url = "{$this->hostName}{$this->projectEndpoint}/{$project->external_id}/collaborators";
        $token = Crypt::decryptString($account->access_token);

        try {
            Log::notice("Calling todoist endpoint $url.");
            $response = Http::withToken($token)
                ->get($url);
        } catch (Throwable $exception) {
            Log::error("Call to todoist endpoint $url failed with exception {$exception->getMessage()}.");
            return null;
        }

        if ($response->failed()) {
            Log::error("Call to todoist endpoint $url failed with response {$response->getStatusCode()}.");
            return null;
        }

        // TODO cursor logic

        $projectUsersPayload = data_get($response->json(),'results');

        if (is_null($projectUsersPayload)) {
            Log::error("getProjectUsers failed due to lack of result in response.");
            return null;
        }

        return $projectUsersPayload;
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
                    'resource_types'=>'["projects"]'
                ]);
        } catch (Throwable $exception) {
            Log::error("Call to todoist endpoint $url failed with exception {$exception->getMessage()}");
            return null;
        }

        if ($response->failed()) {
            Log::error("Call to todoist endpoint $url failed with response {$response->getStatusCode()}");
            return null;
        }

        return $response->json();
    }
}
