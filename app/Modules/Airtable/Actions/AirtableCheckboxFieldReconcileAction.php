<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableCheckboxFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtableCheckboxField;
use App\Modules\Airtable\Models\AirtableField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableCheckboxFieldReconcileAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableCheckboxFieldResourceResponseDto $checkboxFieldResourceResponseDto, AirtableField $field): AirtableCheckboxField
    {
        Log::info('executing AirtableCheckboxFieldReconcileAction', ['checkboxFieldResourceResponseDto' => $checkboxFieldResourceResponseDto, 'field' => $field]);

        $checkboxField = $field->checkboxField()->updateOrCreate(
            [],
            $checkboxFieldResourceResponseDto->options->toArray(),
        );
        Log::notice('created or updated AirtableCheckboxField', ['checkboxField' => $checkboxField, 'checkboxFieldResourceResponseDto' => $checkboxFieldResourceResponseDto]);

        return $checkboxField;
    }
}
