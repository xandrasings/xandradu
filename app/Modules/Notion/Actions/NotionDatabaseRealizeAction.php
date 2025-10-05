<?php

namespace App\Modules\Notion\Actions;

use App\Modules\Notion\Clients\NotionClient;
use App\Modules\Notion\Models\NotionBot;
use App\Modules\Notion\Models\NotionDatabase;
use App\Utilities\ValidationUtility;
use Exception;

class NotionDatabaseRealizeAction
{
    protected NotionClient $client;

    protected ValidationUtility $validationUtility;

    public function __construct()
    {
        $this->client = app(NotionClient::class);
        $this->validationUtility = app(ValidationUtility::class);
    }

    /**
     * @throws Exception
     */
    public function handle(NotionDatabase $database, NotionBot $bot): void
    {
        $response = $this->client->createDatabase($database, $bot);

        $id = data_get($response, 'id');
        $this->validationUtility->isNotNull($id);

        $database->update([
            'external_id' => $id,
        ]);
    }
}
