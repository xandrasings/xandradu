<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Clients\AirtableClient;
use App\Modules\Airtable\Models\AirtableBase;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableTableAllSyncDownAction
{

    protected AirtableClient $client;

    protected AirtableTableReconcileAction $tableReconcileAction;

    public function __construct()
    {
        $this->client = app(AirtableClient::class);

        $this->tableReconcileAction = app(AirtableTableReconcileAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(AirtableBase $base): void
    {
        Log::info('executing AirtableTableAllSyncDownAction');

        $tableListResponseDto = $this->client->listTables($base->external_id);

        $tableListResponseDto->tables->each(function ($tableResourceResponseDto) use ($base) {
            $this->tableReconcileAction->handle($base, $tableResourceResponseDto);
        });

        Log::notice('xan', ['assoc tables' =>$base->tables()->get()]);

        $deletedTables = $base
            ->tables()
            ->whereNotNull('external_id')
            ->whereNotIn('external_id', $tableListResponseDto->tables->pluck('id'))
            ->delete();
        Log::notice('deleted AirtableTables.', ['tables' => $deletedTables]);

    }
}
