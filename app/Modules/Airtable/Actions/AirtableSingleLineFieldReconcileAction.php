<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableAttachmentsFieldResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableFieldResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableSingleLineFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtableAttachmentsField;
use App\Modules\Airtable\Models\AirtableField;
use App\Modules\Airtable\Models\AirtableSingleLineField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableSingleLineFieldReconcileAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableFieldResourceResponseDto $fieldResourceResponseDto, AirtableField $field):  AirtableSingleLineField
    {
        Log::info('executing AirtableSingleLineFieldReconcileAction', ['fieldResourceResponseDto' => $fieldResourceResponseDto, 'field' => $field]);

        if (!($fieldResourceResponseDto instanceof AirtableSingleLineFieldResourceResponseDto)) {
            Log::error('Wrong field type encountered.', ['fieldResourceResponseDto' => $fieldResourceResponseDto]);
            throw new Exception('Wrong field type encountered.');
        }

        $singleLineField = $field->singleLineField()->updateOrCreate(
            []
        );
        Log::notice('created or updated AirtableSingleLineField', ['singleLineField' => $singleLineField, 'fieldResourceResponseDto' => $fieldResourceResponseDto]);

        return $singleLineField;
    }
}
