<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableFieldResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableShortTextFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtableField;
use App\Modules\Airtable\Models\AirtableShortTextField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableShortTextFieldReconcileAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableFieldResourceResponseDto $fieldResourceResponseDto, AirtableField $field):  AirtableShortTextField
    {
        Log::info('executing AirtableShortTextFieldReconcileAction', ['fieldResourceResponseDto' => $fieldResourceResponseDto, 'field' => $field]);

        if (!($fieldResourceResponseDto instanceof AirtableShortTextFieldResourceResponseDto)) {
            Log::error('Wrong field type encountered.', ['fieldResourceResponseDto' => $fieldResourceResponseDto]);
            throw new Exception('Wrong field type encountered.');
        }

        $shortTextField = $field->shortTextField()->updateOrCreate(
            []
        );
        Log::notice('created or updated AirtableShortTextField', ['shortTextField' => $shortTextField, 'fieldResourceResponseDto' => $fieldResourceResponseDto]);

        return $shortTextField;
    }
}
