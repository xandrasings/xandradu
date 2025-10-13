<?php

namespace App\Modules\Notion\Actions;

use App\Modules\Notion\Clients\NotionClient;
use App\Modules\Notion\Models\NotionBot;
use App\Modules\Notion\Models\NotionDatabase;
use App\Utilities\ValidationUtility;
use Exception;

class NotionDatabaseSyncUpAction
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
    public function handle(NotionDatabase $database, NotionBot $bot, bool $includeDatabase = true, bool $includeDataSources = true, bool $includePages = true): void
    {
        if (is_null($database->external_id)) {
            $response = $this->client->createDatabase($database, $bot);

            $id = data_get($response, 'id');
            $dataSourceId = data_get($response, 'data_sources.0.id');
            $this->validationUtility->areNotNull(collect([$id, $dataSourceId]));

            $database->update([
                'external_id' => $id,
            ]);

            $dataSource = $database->dataSources->sortBy('rank')->first();

            $dataSource->update([
                'external_id' => $dataSourceId,
            ]);

            // TODO use column type to identify this
            $titleColumn = $dataSource->columns->sortBy('rank')->first();

            $titleColumn->update([
                'external_id' => 'title',
            ]);
        }

        if ($includeDatabase) {
            // TODO create stub if ext doesn't exist
            $this->client->updateDatabase($database, $bot);
        }

        if ($includeDataSources) {
            // TODO create stub if ext doesn't exist
            $database->dataSources->sortBy('rank')->each(function ($dataSource) use ($bot) {
                if (is_null($dataSource->external_id)) {
                    $response = $this->client->createDataSource($dataSource, $bot);

                    $id = data_get($response, 'id');
                    $this->validationUtility->isNotNull($id);

                    $dataSource->update([
                        'external_id' => $id,
                    ]);

                    // TODO update all the columns with their new external ids


                } else {
                    // TODO update
//                    $response = $this->client->updateDataSource($dataSource, $bot);

                }
            });
        }

        // TODO pages
    }
}
