<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableDurationFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtableDurationField;
use App\Modules\Airtable\Models\AirtableField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableDurationFieldReconcileAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableDurationFieldResourceResponseDto $durationFieldResourceResponseDto, AirtableField $field):  AirtableDurationField
    {
        Log::info('executing AirtableDurationFieldReconcileAction', ['durationFieldResourceResponseDto' => $durationFieldResourceResponseDto, 'field' => $field]);

        $durationField = $field->durationField()->updateOrCreate(
            [],
            $durationFieldResourceResponseDto->options->toArray(),
        );
        Log::notice('created or updated AirtableDurationField', ['durationField' => $durationField, 'durationFieldResourceResponseDto' => $durationFieldResourceResponseDto]);

        return $durationField;
    }
}
