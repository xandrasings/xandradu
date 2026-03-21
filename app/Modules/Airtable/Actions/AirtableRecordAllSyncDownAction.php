<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Clients\AirtableClient;
use App\Modules\Airtable\Models\AirtableTable;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableRecordAllSyncDownAction
{
    protected AirtableClient $client;

    protected AirtableRecordAllReconcileAction $recordAllReconcileAction;

    public function __construct()
    {
        $this->client = app(AirtableClient::class);

        $this->recordAllReconcileAction = app(AirtableRecordAllReconcileAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(AirtableTable $table): void
    {
        Log::info('executing AirtableRecordAllSyncDownAction');

        $recordListResponseDto = $this->client->listRecords($table->base->external_id, $table->external_id);

        $this->recordAllReconcileAction->handle($recordListResponseDto->records, $table);
    }
}
