<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableCreatedAtFieldOptionsDateTimeResultResourceResponseDto;
use App\Modules\Airtable\Models\AirtableCreatedAtField;
use App\Modules\Airtable\Models\AirtableDateTimeCreatedAtField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableDateTimeCreatedAtFieldReconcileAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableCreatedAtFieldOptionsDateTimeResultResourceResponseDto $createdAtFieldOptionsDateTimeResultResourceResponseDto, AirtableCreatedAtField $createdAtField): AirtableDateTimeCreatedAtField
    {
        Log::info('executing AirtableDateTimeCreatedAtFieldReconcileAction', ['createdAtFieldOptionsDateTimeResultResourceResponseDto' => $createdAtFieldOptionsDateTimeResultResourceResponseDto, 'createdAtField' => $createdAtField]);

        $dateTimeCreatedAtField = $createdAtField->dateTimeCreatedAtField()->updateOrCreate(
            [],
            array_merge(
                $createdAtFieldOptionsDateTimeResultResourceResponseDto->options->timeFormat->toArray(),
                $createdAtFieldOptionsDateTimeResultResourceResponseDto->options->except('dateFormat', 'timeFormat')->toArray()
            ),
        );
        Log::notice('created or updated AirtableDateTimeCreatedAtField', ['dateTimeCreatedAtField' => $dateTimeCreatedAtField, 'createdAtFieldOptionsDateTimeResultResourceResponseDto' => $createdAtFieldOptionsDateTimeResultResourceResponseDto]);

        return $dateTimeCreatedAtField;
    }
}
