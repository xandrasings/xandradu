<?php

namespace App\Modules\Airtable\Actions;

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
    public function handle(AirtableShortTextFieldResourceResponseDto $shortTextFieldResourceResponseDto, AirtableField $field): AirtableShortTextField
    {
        Log::info('executing AirtableShortTextFieldReconcileAction', ['shortTextFieldResourceResponseDto' => $shortTextFieldResourceResponseDto, 'field' => $field]);

        $shortTextField = $field->shortTextField()->updateOrCreate(
            []
        );
        Log::notice('created or updated AirtableShortTextField', ['shortTextField' => $shortTextField, 'shortTextFieldResourceResponseDto' => $shortTextFieldResourceResponseDto]);

        return $shortTextField;
    }
}
