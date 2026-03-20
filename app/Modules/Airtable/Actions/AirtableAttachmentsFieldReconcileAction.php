<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableAttachmentsFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtableAttachmentsField;
use App\Modules\Airtable\Models\AirtableField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableAttachmentsFieldReconcileAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableAttachmentsFieldResourceResponseDto $attachmentsFieldResourceResponseDto, AirtableField $field): AirtableAttachmentsField
    {
        Log::info('executing AirtableAttachmentsFieldReconcileAction', ['attachmentsFieldResourceResponseDto' => $attachmentsFieldResourceResponseDto, 'field' => $field]);

        $attachmentsField = $field->attachmentsField()->updateOrCreate(
            [],
            $attachmentsFieldResourceResponseDto->options->toArray(),
        );
        Log::notice('created or updated AirtableAttachmentsField', ['attachmentsField' => $attachmentsField, 'attachmentsFieldResourceResponseDto' => $attachmentsFieldResourceResponseDto]);

        return $attachmentsField;
    }
}
