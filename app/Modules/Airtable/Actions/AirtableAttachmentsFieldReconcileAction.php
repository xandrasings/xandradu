<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableOptionsResourceResponseDto;
use App\Modules\Airtable\Models\AirtableAttachmentsField;
use App\Modules\Airtable\Models\AirtableField;
use Exception;
use Illuminate\Support\Facades\Log;
use Spatie\LaravelData\Optional;

class AirtableAttachmentsFieldReconcileAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableOptionsResourceResponseDto|Optional $optionResourceResponseDto, AirtableField $field):  AirtableAttachmentsField
    {
        Log::info('executing AirtableAttachmentsFieldReconcileAction', ['optionResourceResponseDto' => $optionResourceResponseDto, 'field' => $field]);

        // TODO arg&field validation

        $attachmentsField = $field->attachmentsField()->updateOrCreate(
            [],
            $optionResourceResponseDto->toArray(),
        );
        Log::notice('created or updated AirtableAttachmentsField', ['field' => $field, 'attachmentsFieldOptionsResourceResponseDto' => $optionResourceResponseDto]);

        return $attachmentsField;
    }
}
