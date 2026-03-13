<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableFieldResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableMultipleLineFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtableField;
use App\Modules\Airtable\Models\AirtableMultipleLineField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableMultipleLineFieldReconcileAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableFieldResourceResponseDto $fieldResourceResponseDto, AirtableField $field):  AirtableMultipleLineField
    {
        Log::info('executing AirtableMultipleLineFieldReconcileAction', ['fieldResourceResponseDto' => $fieldResourceResponseDto, 'field' => $field]);

        if (!($fieldResourceResponseDto instanceof AirtableMultipleLineFieldResourceResponseDto)) {
            Log::error('Wrong field type encountered.', ['fieldResourceResponseDto' => $fieldResourceResponseDto]);
            throw new Exception('Wrong field type encountered.');
        }

        $multipleLineField = $field->multipleLineField()->updateOrCreate(
            []
        );
        Log::notice('created or updated AirtableMultipleLineField', ['multipleLineField' => $multipleLineField, 'fieldResourceResponseDto' => $fieldResourceResponseDto]);

        return $multipleLineField;
    }
}
