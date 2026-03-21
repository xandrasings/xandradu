<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Clients\AirtableClient;
use App\Modules\Airtable\Jobs\AirtableRecordAllSyncDownJob;
use App\Modules\Airtable\Models\AirtableBase;
use App\Modules\Airtable\Models\AirtableTable;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableTableAllSyncDownAction
{
    protected AirtableClient $client;

    protected AirtableTableAllReconcileAction $tableAllReconcileAction;

    public function __construct()
    {
        $this->client = app(AirtableClient::class);

        $this->tableAllReconcileAction = app(AirtableTableAllReconcileAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(AirtableBase $base): void
    {
        Log::info('executing AirtableTableAllSyncDownAction');

        $tableResourceListResponseDto = $this->client->listTables($base->external_id);

        $this->tableAllReconcileAction->handle($tableResourceListResponseDto->tables, $base);

        $base->tables()->each(function (AirtableTable $table) {
            dispatch(new AirtableRecordAllSyncDownJob($table));
        });
    }
}
