<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableCheckboxFieldResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtableCheckboxField;
use App\Modules\Airtable\Models\AirtableField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableCheckboxFieldReconcileAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableFieldResourceResponseDto $fieldResourceResponseDto, AirtableField $field):  AirtableCheckboxField
    {
        Log::info('executing AirtableCheckboxFieldReconcileAction', ['fieldResourceResponseDto' => $fieldResourceResponseDto, 'field' => $field]);


        if (!($fieldResourceResponseDto instanceof AirtableCheckboxFieldResourceResponseDto)) {
            throw new Exception('Wrong field type encountered.', ['fieldResourceResponseDto' => $fieldResourceResponseDto]);
        }

        $checkboxField = $field->checkboxField()->updateOrCreate(
            [],
            $fieldResourceResponseDto->options->toArray(),
        );
        Log::notice('created or updated AirtableCheckboxField', ['field' => $field, 'checkboxFieldResourceResponseDto' => $fieldResourceResponseDto]);

        return $checkboxField;
    }
}
