<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableAttachmentsFieldResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtableAttachmentsField;
use App\Modules\Airtable\Models\AirtableField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableAttachmentsFieldReconcileAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableFieldResourceResponseDto $fieldResourceResponseDto, AirtableField $field):  AirtableAttachmentsField
    {
        Log::info('executing AirtableAttachmentsFieldReconcileAction', ['fieldResourceResponseDto' => $fieldResourceResponseDto, 'field' => $field]);

        if (!($fieldResourceResponseDto instanceof AirtableAttachmentsFieldResourceResponseDto)) {
            throw new Exception('Wrong field type encountered.', ['fieldResourceResponseDto' => $fieldResourceResponseDto]);
        }

        $attachmentsField = $field->attachmentsField()->updateOrCreate(
            [],
            $fieldResourceResponseDto->options->toArray(),
        );
        Log::notice('created or updated AirtableAttachmentsField', ['attachmentsField' => $attachmentsField, 'fieldResourceResponseDto' => $fieldResourceResponseDto]);

        return $attachmentsField;
    }
}
