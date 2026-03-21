<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableRecordResourceResponseDto;
use App\Modules\Airtable\Models\AirtableRecord;
use App\Modules\Airtable\Models\AirtableTable;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class AirtableRecordAllReconcileAction
{
    protected AirtableRecordReconcileAction $recordReconcileAction;

    protected AirtableRecordAllTrashAction $recordAllTrashAction;

    public function __construct()
    {
        $this->recordReconcileAction = app(AirtableRecordReconcileAction::class);

        $this->recordAllTrashAction = app(AirtableRecordAllTrashAction::class);
    }

    /**
     * @param  Collection<AirtableRecordResourceResponseDto>  $recordResourceResponseDtos
     * @return Collection<AirtableRecord>
     *
     * @throws Exception
     */
    public function handle(Collection $recordResourceResponseDtos, AirtableTable $table): Collection
    {
        Log::info('executing AirtableRecordAllReconcileAction');

        $records = $recordResourceResponseDtos
            ->map(function (AirtableRecordResourceResponseDto $recordResourceResponseDto) use ($table) {
                return $this->recordReconcileAction->handle($recordResourceResponseDto, $table);
            });

        // TODO confirm no offset logic at play when record schema gets grabbed
        $trashableRecords = $table->records()
            ->whereNotNull('external_id')
            ->whereNotIn('id', $records->pluck('id'))
            ->get();
        $this->recordAllTrashAction->handle($trashableRecords);

        return $records;
    }
}
