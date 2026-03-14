<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableNumberFieldResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtableNumberField;
use App\Modules\Airtable\Models\AirtableField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableNumberFieldReconcileAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableFieldResourceResponseDto $fieldResourceResponseDto, AirtableField $field):  AirtableNumberField
    {
        Log::info('executing AirtableNumberFieldReconcileAction', ['fieldResourceResponseDto' => $fieldResourceResponseDto, 'field' => $field]);

        if (!($fieldResourceResponseDto instanceof AirtableNumberFieldResourceResponseDto)) {
            Log::error('Wrong field type encountered.', ['fieldResourceResponseDto' => $fieldResourceResponseDto]);
            throw new Exception('Wrong field type encountered.');
        }

        $numberField = $field->numberField()->updateOrCreate(
            [],
            $fieldResourceResponseDto->options->toArray(),
        );
        Log::notice('created or updated AirtableNumberField', ['numberField' => $numberField, 'fieldResourceResponseDto' => $fieldResourceResponseDto]);

        return $numberField;
    }
}
