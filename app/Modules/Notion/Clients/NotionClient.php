<?php

namespace App\Modules\Notion\Clients;

use App\Models\NotionBot;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class NotionClient
{
    private string $version;

    private string $hostName;

    private string $usersEndpoint;

    private string $databasesEndpoint;

    private string $pagesEndpoint;

    public function __construct()
    {
        $this->version = config('services.notion.version');
        $this->hostName = config('services.notion.host_name');
        $this->usersEndpoint = config('services.notion.users_endpoint');
        $this->databasesEndpoint = config('services.notion.databases_endpoint');
        $this->pagesEndpoint = config('services.notion.pages_endpoint');
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

    public function getPage(string $id, NotionBot $bot): ?array
    {
        $url = "$this->hostName/$this->pagesEndpoint/$id";
        $token = Crypt::decryptString($bot->token);

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
            $message = data_get($response->json(), 'message');
            if (str_contains($message, 'is a database, not a page.')) {
                Log::info("Call to notion endpoint $url indicated wrong node type.");
                return null;
            }

            Log::warning("Call to notion endpoint $url failed with response {$response->getStatusCode()}");
            return null;
        }

        return $response->json();
    }

    public function getDatabase(string $id, NotionBot $bot): ?array
    {
        $url = "$this->hostName/$this->databasesEndpoint/$id";
        $token = Crypt::decryptString($bot->token);

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
            $message = data_get($response->json(), 'message');
            if (str_contains($message, 'is a page, not a database.')) {
                Log::info("Call to notion endpoint $url indicated wrong node type.");
                return null;
            }

            Log::warning("Call to notion endpoint $url failed with response {$response->getStatusCode()}");
            return null;
        }

        return $response->json();
    }
}
