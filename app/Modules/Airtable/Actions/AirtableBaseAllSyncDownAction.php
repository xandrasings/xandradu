<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Clients\AirtableClient;
use App\Modules\Airtable\Models\AirtableBase;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableBaseAllSyncDownAction
{
    protected AirtableClient $client;

    protected AirtableBaseAllReconcileAction $baseAllReconcileAction;

    protected AirtableTableAllSyncDownAction $tableAllSyncDownAction;

    public function __construct()
    {
        $this->client = app(AirtableClient::class);

        $this->baseAllReconcileAction = app(AirtableBaseAllReconcileAction::class);

        $this->tableAllSyncDownAction = app(AirtableTableAllSyncDownAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(): void
    {
        Log::info('executing AirtableBaseAllSyncDownAction');

        $baseListResponseDto = $this->client->listBases();
        // TODO deal with offsets so allreconcile is really all

        $activeExternalBases = $this->baseAllReconcileAction->handle($baseListResponseDto->bases);

        $activeExternalBases->each(function (AirtableBase $base) {
            $this->tableAllSyncDownAction->handle($base);
        });
    }
}
