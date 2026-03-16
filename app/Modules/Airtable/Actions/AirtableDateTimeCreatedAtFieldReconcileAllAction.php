<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableCreatedAtFieldOptionsDateResultResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableCreatedAtFieldOptionsDateTimeResultResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableCreatedAtFieldOptionsResultResourceResponseDto;
use App\Modules\Airtable\Models\AirtableCreatedAtField;
use App\Modules\Airtable\Models\AirtableDateTimeCreatedAtField;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class AirtableDateTimeCreatedAtFieldReconcileAllAction
{
    /**
     * @return Collection<AirtableDateTimeCreatedAtField>
     * @throws Exception
     */
    public function handle(AirtableCreatedAtFieldOptionsResultResourceResponseDto $createdAtFieldOptionsResultResourceResponseDto, AirtableCreatedAtField $createdAtField): Collection
    {
        Log::info('executing AirtableDateTimeCreatedAtFieldReconcileAllAction', ['createdAtFieldOptionsResultResourceResponseDto' => $createdAtFieldOptionsResultResourceResponseDto, 'createdAtField' => $createdAtField]);

        switch (true) {
            case $createdAtFieldOptionsResultResourceResponseDto instanceof AirtableCreatedAtFieldOptionsDateTimeResultResourceResponseDto:
                $dateTimeCreatedAtField = $createdAtField->dateTimeCreatedAtField()->updateOrCreate(
                    [],
                    array_merge(
                        $createdAtFieldOptionsResultResourceResponseDto->options->timeFormat->only('format')->toArray(),
                        $createdAtFieldOptionsResultResourceResponseDto->options->only('timeZone')->toArray())
                );
                Log::notice('created or updated AirtableDateTimeCreatedAtField', ['dateTimeCreatedAtField' => $dateTimeCreatedAtField, 'createdAtFieldOptionsResultResourceResponseDto' => $createdAtFieldOptionsResultResourceResponseDto]);
                return collect($dateTimeCreatedAtField);
            case $createdAtFieldOptionsResultResourceResponseDto instanceof AirtableCreatedAtFieldOptionsDateResultResourceResponseDto:
                $dateTimeCreatedAtField = $createdAtField->dateTimeCreatedAtField();
                $dateTimeCreatedAtField->delete();
                Log::notice('deleted AirtableDateTimeCreatedAtField.', ['dateTimeCreatedAtField' => $dateTimeCreatedAtField]);
                return collect();
            default:
                throw new Exception('Encountered AirtableCreatedAtFieldOptionsResultResourceResponseDto class of unrecognized subtype.');
        }
    }
}
