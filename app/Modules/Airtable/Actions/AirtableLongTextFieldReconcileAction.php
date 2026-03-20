<?php

namespace App\Modules\Airtable\Actions;

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
    public function handle(AirtableLongTextFieldResourceResponseDto $longTextFieldResourceResponseDto, AirtableField $field): AirtableLongTextField
    {
        Log::info('executing AirtableLongTextFieldReconcileAction', ['longTextFieldResourceResponseDto' => $longTextFieldResourceResponseDto, 'field' => $field]);

        $longTextField = $field->longTextField()->updateOrCreate(
            [],
        );
        Log::notice('created or updated AirtableLongTextField', ['longTextField' => $longTextField, 'longTextFieldResourceResponseDto' => $longTextFieldResourceResponseDto]);

        return $longTextField;
    }
}
