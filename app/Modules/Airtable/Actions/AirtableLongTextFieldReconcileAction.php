<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableFieldResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableLongTextFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtableField;
use App\Modules\Airtable\Models\AirtableLongTextField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableLongTextFieldReconcileAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableFieldResourceResponseDto $fieldResourceResponseDto, AirtableField $field):  AirtableLongTextField
    {
        Log::info('executing AirtableLongTextFieldReconcileAction', ['fieldResourceResponseDto' => $fieldResourceResponseDto, 'field' => $field]);

        if (!($fieldResourceResponseDto instanceof AirtableLongTextFieldResourceResponseDto)) {
            Log::error('Wrong field type encountered.', ['fieldResourceResponseDto' => $fieldResourceResponseDto]);
            throw new Exception('Wrong field type encountered.');
        }

        $longTextField = $field->longTextField()->updateOrCreate(
            []
        );
        Log::notice('created or updated AirtableLongTextField', ['longTextField' => $longTextField, 'fieldResourceResponseDto' => $fieldResourceResponseDto]);

        return $longTextField;
    }
}
