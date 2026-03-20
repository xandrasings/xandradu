<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableEmailAddressFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtableEmailAddressField;
use App\Modules\Airtable\Models\AirtableField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableEmailAddressFieldReconcileAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableEmailAddressFieldResourceResponseDto $emailAddressFieldResourceResponseDto, AirtableField $field): AirtableEmailAddressField
    {
        Log::info('executing AirtableEmailAddressFieldReconcileAction', ['emailAddressFieldResourceResponseDto' => $emailAddressFieldResourceResponseDto, 'field' => $field]);

        $emailAddressField = $field->emailAddressField()->updateOrCreate(
            [],
        );
        Log::notice('created or updated AirtableEmailAddressField', ['emailAddressField' => $emailAddressField, 'emailAddressFieldResourceResponseDto' => $emailAddressFieldResourceResponseDto]);

        return $emailAddressField;
    }
}
