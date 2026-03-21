<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableDateAndTimeFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtableDateAndTimeField;
use App\Modules\Airtable\Models\AirtableField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableDateAndTimeFieldReconcileAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableDateAndTimeFieldResourceResponseDto $dateAndTimeFieldResourceResponseDto, AirtableField $field): AirtableDateAndTimeField
    {
        Log::info('executing AirtableDateAndTimeFieldReconcileAction', ['dateAndTimeFieldResourceResponseDto' => $dateAndTimeFieldResourceResponseDto, 'field' => $field]);

        $dateAndTimeField = $field->dateAndTimeField()->updateOrCreate(
            [],
            array_merge(
                ['date_format' => $dateAndTimeFieldResourceResponseDto->options->dateFormat->format],
                $dateAndTimeFieldResourceResponseDto->options->timeFormat->toArray(),
                $dateAndTimeFieldResourceResponseDto->options->except('dateFormat', 'timeFormat')->toArray(),
            )
        );
        Log::notice('created or updated AirtableDateAndTimeField', ['dateAndTimeField' => $dateAndTimeField, 'dateAndTimeFieldResourceResponseDto' => $dateAndTimeFieldResourceResponseDto]);

        return $dateAndTimeField;
    }
}
