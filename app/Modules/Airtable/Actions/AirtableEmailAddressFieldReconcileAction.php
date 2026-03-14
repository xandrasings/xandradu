<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableEmailAddressFieldResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtableEmailAddressField;
use App\Modules\Airtable\Models\AirtableField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableEmailAddressFieldReconcileAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableFieldResourceResponseDto $fieldResourceResponseDto, AirtableField $field):  AirtableEmailAddressField
    {
        Log::info('executing AirtableEmailAddressFieldReconcileAction', ['fieldResourceResponseDto' => $fieldResourceResponseDto, 'field' => $field]);

        if (!($fieldResourceResponseDto instanceof AirtableEmailAddressFieldResourceResponseDto)) {
            Log::error('Wrong field type encountered.', ['fieldResourceResponseDto' => $fieldResourceResponseDto]);
            throw new Exception('Wrong field type encountered.');
        }

        $emailAddressField = $field->emailAddressField()->updateOrCreate(
            [],
        );
        Log::notice('created or updated AirtableEmailAddressField', ['emailAddressField' => $emailAddressField, 'fieldResourceResponseDto' => $fieldResourceResponseDto]);

        return $emailAddressField;
    }
}
