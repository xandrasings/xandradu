<?php

namespace App\Modules\Todoist\Clients;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class TodoistClient
{
    private string $hostName;

    private string $userEndpoint;

    public function __construct()
    {
        $this->hostName = config('services.todoist.host_name');
        $this->userEndpoint = config('services.todoist.user_endpoint');
    }

    public function getUser(string $token): ?array
    {
        $url = "$this->hostName$this->userEndpoint";

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
        }

        return $response->json();
    }
}
