<?php

namespace App\Modules\Notion\Actions;

use App\Modules\Notion\Clients\NotionClient;
use App\Modules\Notion\Models\NotionBot;
use App\Modules\Notion\Models\NotionDatabase;
use App\Utilities\ValidationUtility;
use Illuminate\Support\Facades\Log;
use Throwable;

class NotionDatabaseRealizeAction
{
    protected NotionClient $client;

    protected ValidationUtility $validationUtility;

    public function __construct()
    {
        $this->client = app(NotionClient::class);
        $this->validationUtility = app(ValidationUtility::class);
    }

    public function handle(NotionDatabase $database, NotionBot $bot): bool
    {
        $response = $this->client->createDatabase($database, $bot);
        if (is_null($response)) {
            Log::warning("NotionDatabaseRealizeAction failed due to unsuccessful client call.");
            return false;
        }

        $id = data_get($response, 'id');
        if (! $this->validationUtility->containsNoNulls([$id])) {
            Log::critical("NotionDatabaseRealizeAction failed due to a missing non-nullable variable");
            return false;
        }

        try {
            $database->update([
                'external_id' => $id,
            ]);
        } catch (Throwable $exception) {
            Log::critical("NotionDatabaseRealizeAction failed with exception {$exception->getMessage()}.");
            return false;
        }

        return true;
    }
}
