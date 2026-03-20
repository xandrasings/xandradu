<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableButtonFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtableButtonField;
use App\Modules\Airtable\Models\AirtableField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableButtonFieldReconcileAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableButtonFieldResourceResponseDto $buttonFieldResourceResponseDto, AirtableField $field): AirtableButtonField
    {
        Log::info('executing AirtableButtonFieldReconcileAction', ['buttonFieldResourceResponseDto' => $buttonFieldResourceResponseDto, 'field' => $field]);

        $buttonField = $field->buttonField()->updateOrCreate(
            [],
        );
        Log::notice('created or updated AirtableButtonField', ['buttonField' => $buttonField, 'buttonFieldResourceResponseDto' => $buttonFieldResourceResponseDto]);

        return $buttonField;
    }
}
