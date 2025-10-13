<?php

namespace App\Modules\Notion\Clients;

use App\Modules\Notion\Models\NotionBot;
use App\Modules\Notion\Models\NotionColumn;
use App\Modules\Notion\Models\NotionDatabase;
use Exception;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use stdClass;

class NotionClient
{
    private string $spacesEndpoint;

    private string $version;

    private string $hostName;

    private string $usersEndpoint;

    private string $databasesEndpoint;

    private string $pagesEndpoint;

    public function __construct()
    {
        $this->spacesEndpoint = config('services.spaces.endpoint');
        $this->version = config('services.notion.version');
        $this->hostName = config('services.notion.host_name');
        $this->usersEndpoint = config('services.notion.users_endpoint');
        $this->databasesEndpoint = config('services.notion.databases_endpoint');
        $this->pagesEndpoint = config('services.notion.pages_endpoint');
    }

    /**
     * @throws Exception
     */
    public function getUser(string $token): array
    {
        $url = "$this->hostName/$this->usersEndpoint/me";

        Log::notice("Calling notion endpoint $url.");
        $response = Http::withToken($token)
            ->withHeaders([
                'Notion-Version' => $this->version,
            ])
            ->get($url);

        if ($response->failed()) {
            throw new Exception("Call to notion endpoint $url failed with response {$response->getStatusCode()}.");
        }

        return $response->json();
    }

    /**
     * @throws Exception
     */
    public function getPage(string $id, NotionBot $bot): ?array
    {
        $url = "$this->hostName/$this->pagesEndpoint/$id";
        $token = Crypt::decryptString($bot->token);

        Log::notice("Calling notion endpoint $url.");
        $response = Http::withToken($token)
            ->withHeaders([
                'Notion-Version' => $this->version,
            ])
            ->get($url);

        if ($response->failed()) {
            $message = data_get($response->json(), 'message');
            throw new Exception("Call to notion endpoint $url failed with response {$response->getStatusCode()} and message $message}.",);
        }

        return $response->json();
    }

    /**
     * @throws Exception
     */
    public function createDatabase(NotionDatabase $database, NotionBot $bot): array
    {
        $url = "$this->hostName/$this->databasesEndpoint";
        $token = Crypt::decryptString($bot->token);
        $body = $this->generateCreateDatabaseBody($database);

        Log::notice("Calling notion endpoint $url.", ['body' => $body]);
        $response = Http::withToken($token)
            ->withHeaders([
                'Notion-Version' => $this->version,
            ])
            ->post($url, $body);

        if ($response->failed()) {
            throw new Exception("Call to notion endpoint $url failed with response {$response->getStatusCode()}");
        }

        return $response->json();
    }

    private function generateCreateDatabaseBody(NotionDatabase $database): array
    {
        return [
            'parent' => $this->generateBodyParent($database),
            'icon' => $this->generateBodyIcon($database),
            'title' => $this->generateBodyTitle($database),
            'initial_data_source' => $this->generateBodyInitialDataSource($database),
        ];
    }

    private function generateBodyParent(NotionDatabase $database): array
    {
        // TODO correctly choose the parent type and generate appropriate array
        return [
            'type' => 'page_id',
            'page_id' => $database->node->parent->page->external_id,
        ];
    }

    private function generateBodyIcon(NotionDatabase $database): array
    {
        if (is_null($database->icon)) {
            return [
                'type' => 'emoji',
                'emoji' => "❌"
            ];
        }

        return [
            'type' => 'external',
            'external' => [
                'url' => "$this->spacesEndpoint{$database->icon->path}",
            ]
        ];
    }

    private function generateBodyTitle(NotionDatabase $database): array
    {
        return [
            [
                'type' => 'text',
                'text' => [
                    'content' => $database->title,
                    'link' => null
                ]
            ]
        ];
    }

    private function generateBodyInitialDataSource(NotionDatabase $database): array
    {
        $dataSource = $database->dataSources->sortBy('rank')->first();
        // TODO search based on column type

        // TODO deal select column based on column type
        $column = $dataSource->columns->sortBy('rank')->first();

        return [
            'properties' => [
                $column->name => [
                    'title' => new stdClass()
                ],
            ]
        ];
    }

    private function generateBodyProperties(NotionDatabase $database): array
    {
        // TODO generate properties programmatically
        return  [
            'Column 1' => [
                'title' => new stdClass()
            ],
        ];
    }
}
