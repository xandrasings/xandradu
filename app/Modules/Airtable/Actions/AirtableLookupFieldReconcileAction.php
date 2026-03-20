<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableLookupFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtableField;
use App\Modules\Airtable\Models\AirtableLookupField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableLookupFieldReconcileAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableLookupFieldResourceResponseDto $lookupFieldResourceResponseDto, AirtableField $field): AirtableLookupField
    {
        Log::info('executing AirtableLookupFieldReconcileAction', ['lookupFieldResourceResponseDto' => $lookupFieldResourceResponseDto, 'field' => $field]);

        $lookupField = $field->lookupField()->updateOrCreate(
            [],
            $lookupFieldResourceResponseDto->options->toArray(),
        );
        Log::notice('created or updated AirtableLookupField', ['lookupField' => $lookupField, 'lookupFieldResourceResponseDto' => $lookupFieldResourceResponseDto]);

        return $lookupField;
    }
}
