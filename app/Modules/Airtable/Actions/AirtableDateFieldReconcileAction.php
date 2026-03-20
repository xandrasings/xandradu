<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableDateFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtableDateField;
use App\Modules\Airtable\Models\AirtableField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableDateFieldReconcileAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableDateFieldResourceResponseDto $dateFieldResourceResponseDto, AirtableField $field): AirtableDateField
    {
        Log::info('executing AirtableDateFieldReconcileAction', ['dateFieldResourceResponseDto' => $dateFieldResourceResponseDto, 'field' => $field]);

        $dateField = $field->dateField()->updateOrCreate(
            [],
            $dateFieldResourceResponseDto->options->dateFormat->only('format')->toArray(),
        );
        Log::notice('created or updated AirtableDateField', ['dateField' => $dateField, 'dateFieldResourceResponseDto' => $dateFieldResourceResponseDto]);

        return $dateField;
    }
}
