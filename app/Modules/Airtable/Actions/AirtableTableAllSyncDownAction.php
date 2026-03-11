<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Clients\AirtableClient;
use App\Modules\Airtable\Models\AirtableBase;
use App\Modules\Airtable\Models\AirtableTable;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableTableAllSyncDownAction
{

    protected AirtableClient $client;

    protected AirtableTableAllReconcileAction $tableAllReconcileAction;

//    protected AirtableFieldAllReconcileAction $fieldAllReconcileAction;

    public function __construct()
    {
        $this->client = app(AirtableClient::class);

        $this->tableAllReconcileAction = app(AirtableTableAllReconcileAction::class);

//        $this->fieldAllReconcileAction = app(AirtableFieldAllReconcileAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(AirtableBase $base): void
    {
        Log::info('executing AirtableTableAllSyncDownAction');

        $tableListResponseDto = $this->client->listTables($base->external_id);

        $activeExternalTables = $this->tableAllReconcileAction->handle($tableListResponseDto->tables, $base);

    }
}
