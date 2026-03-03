<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Clients\AirtableClient;
use App\Modules\Airtable\Models\AirtableBase;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableBaseAllSyncDownAction
{

    protected AirtableClient $client;

    protected AirtableBaseReconcileAction $baseReconcileAction;

    protected AirtableTableAllSyncDownAction $tableAllSyncDownAction;

    public function __construct()
    {
        $this->client = app(AirtableClient::class);

        $this->baseReconcileAction = app(AirtableBaseReconcileAction::class);

        $this->tableAllSyncDownAction = app(AirtableTableAllSyncDownAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(): void
    {
        Log::info('executing AirtableBaseAllSyncDownAction');

        $baseListResponseDto = $this->client->listBases();

        $baseListResponseDto->bases->each(function ($baseResourceResponseDto) {
            $base = $this->baseReconcileAction->handle($baseResourceResponseDto);

            $this->tableAllSyncDownAction->handle($base);
        });
        // TODO currently assumes no need for calling for additional because the offset is so high at 1000

        $deletedBases = AirtableBase::query()
            ->whereNotNull('external_id')
            ->whereNotIn('external_id', $baseListResponseDto->bases->pluck('id'))
            ->delete();
        Log::notice('deleted AirtableBases.', ['bases' => $deletedBases]);

    }
}
