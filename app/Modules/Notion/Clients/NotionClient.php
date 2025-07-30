<?php

namespace App\Modules\Notion\Clients;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class NotionClient
{
    private string $version;

    private string $hostName;

    private string $usersEndpoint;

    public function __construct()
    {
        $this->version = config('services.notion.version');
        $this->hostName = config('services.notion.host_name');
        $this->usersEndpoint = config('services.notion.users_endpoint');
    }

    public function getUser(string $token): ?array
    {
        $url = "$this->hostName/$this->usersEndpoint/me";

        try {
            Log::notice("Calling notion endpoint $url.");
            $response = Http::withToken($token)
                ->withHeaders([
                    'Notion-Version' => $this->version,
                ])
                ->get($url);
        } catch (Throwable $exception) {
            Log::warning("Call to notion endpoint $url failed with exception {$exception->getMessage()}");
            return null;
        }

        if ($response->failed()) {
            Log::warning("Call to notion endpoint $url failed with response {$response->getStatusCode()}");
            return null;
        }

        return $response->json();
    }
}
