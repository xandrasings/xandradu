<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtablePhoneNumberFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtablePhoneNumberField;
use App\Modules\Airtable\Models\AirtableField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtablePhoneNumberFieldReconcileAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtablePhoneNumberFieldResourceResponseDto $phoneNumberFieldResourceResponseDto, AirtableField $field):  AirtablePhoneNumberField
    {
        Log::info('executing AirtablePhoneNumberFieldReconcileAction', ['phoneNumberFieldResourceResponseDto' => $phoneNumberFieldResourceResponseDto, 'field' => $field]);

        $phoneNumberField = $field->phoneNumberField()->updateOrCreate(
            [],
        );
        Log::notice('created or updated AirtablePhoneNumberField', ['phoneNumberField' => $phoneNumberField, 'phoneNumberFieldResourceResponseDto' => $phoneNumberFieldResourceResponseDto]);

        return $phoneNumberField;
    }
}
