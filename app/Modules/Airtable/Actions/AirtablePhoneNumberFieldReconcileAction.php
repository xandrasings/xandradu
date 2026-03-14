<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtablePhoneNumberFieldResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtablePhoneNumberField;
use App\Modules\Airtable\Models\AirtableField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtablePhoneNumberFieldReconcileAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableFieldResourceResponseDto $fieldResourceResponseDto, AirtableField $field):  AirtablePhoneNumberField
    {
        Log::info('executing AirtablePhoneNumberFieldReconcileAction', ['fieldResourceResponseDto' => $fieldResourceResponseDto, 'field' => $field]);

        if (!($fieldResourceResponseDto instanceof AirtablePhoneNumberFieldResourceResponseDto)) {
            Log::error('Wrong field type encountered.', ['fieldResourceResponseDto' => $fieldResourceResponseDto]);
            throw new Exception('Wrong field type encountered.');
        }

        $phoneNumberField = $field->phoneNumberField()->updateOrCreate(
            [],
        );
        Log::notice('created or updated AirtablePhoneNumberField', ['phoneNumberField' => $phoneNumberField, 'fieldResourceResponseDto' => $fieldResourceResponseDto]);

        return $phoneNumberField;
    }
}
