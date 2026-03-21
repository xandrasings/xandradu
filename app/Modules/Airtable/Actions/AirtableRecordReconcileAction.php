<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableRecordResourceResponseDto;
use App\Modules\Airtable\Models\AirtableRecord;
use App\Modules\Airtable\Models\AirtableTable;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableRecordReconcileAction
{
    //    protected AirtableFieldAllReconcileAction $fieldAllReconcileAction;
    //
    //    protected AirtableViewAllReconcileAction $viewAllReconcileAction;
    //
    //    public function __construct()
    //    {
    //        $this->fieldAllReconcileAction = app(AirtableFieldAllReconcileAction::class);
    //
    //        $this->viewAllReconcileAction = app(AirtableViewAllReconcileAction::class);
    //    }

    /**
     * @throws Exception
     */
    public function handle(AirtableRecordResourceResponseDto $recordResourceResponseDto, AirtableTable $table): AirtableRecord
    {
        Log::info('executing AirtableRecordReconcileAction', ['recordResourceResponseDto' => $recordResourceResponseDto, 'table' => $table]);

        $record = $table->records()->updateOrCreate(
            $recordResourceResponseDto->only('id')->toArray(),
        );
        Log::notice('created or updated AirtableRecord', ['record' => $record, 'recordResourceResponseDto' => $recordResourceResponseDto]);

        //        $this->fieldAllReconcileAction->handle($recordResourceResponseDto->fields, $record);
        //
        //        $this->viewAllReconcileAction->handle($recordResourceResponseDto->views, $record);

        return $record;
    }
}
