<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableUpdatedAtFieldOptionsDateTimeResultResourceResponseDto;
use App\Modules\Airtable\Models\AirtableDateTimeUpdatedAtField;
use App\Modules\Airtable\Models\AirtableUpdatedAtField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableDateTimeUpdatedAtFieldReconcileAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableUpdatedAtFieldOptionsDateTimeResultResourceResponseDto $updatedAtFieldOptionsDateTimeResultResourceResponseDto, AirtableUpdatedAtField $updatedAtField): AirtableDateTimeUpdatedAtField
    {
        Log::info('executing AirtableDateTimeUpdatedAtFieldReconcileAction', ['updatedAtFieldOptionsDateTimeResultResourceResponseDto' => $updatedAtFieldOptionsDateTimeResultResourceResponseDto, 'updatedAtField' => $updatedAtField]);

        $dateTimeUpdatedAtField = $updatedAtField->dateTimeUpdatedAtField()->updateOrCreate(
            [],
            array_merge(
                $updatedAtFieldOptionsDateTimeResultResourceResponseDto->options->timeFormat->toArray(),
                $updatedAtFieldOptionsDateTimeResultResourceResponseDto->options->except('dateFormat', 'timeFormat')->toArray()
            ),
        );
        Log::notice('updated or updated AirtableDateTimeUpdatedAtField', ['dateTimeUpdatedAtField' => $dateTimeUpdatedAtField, 'updatedAtFieldOptionsDateTimeResultResourceResponseDto' => $updatedAtFieldOptionsDateTimeResultResourceResponseDto]);

        return $dateTimeUpdatedAtField;
    }
}
