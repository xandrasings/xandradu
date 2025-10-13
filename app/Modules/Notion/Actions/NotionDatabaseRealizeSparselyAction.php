<?php

namespace App\Modules\Notion\Actions;

use App\Modules\Notion\Clients\NotionClient;
use App\Modules\Notion\Models\NotionBot;
use App\Modules\Notion\Models\NotionDatabase;
use App\Utilities\ValidationUtility;
use Exception;

class NotionDatabaseRealizeSparselyAction
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
        $dataSourceId = data_get($response, 'data_sources.0.id');
        $this->validationUtility->areNotNull(collect($id, $dataSourceId));

        $database->update([
            'external_id' => $id,
        ]);

        $dataSource = $database->dataSources->sortBy('rank')->first();

        $dataSource->update([
            'external_id' => $dataSourceId,
        ]);

        // TODO use column type
        $titleColumn = $dataSource->columns->sortBy('rank')->first();

        $titleColumn->update([
            'external_id' => 'title',
        ]);
    }
}
