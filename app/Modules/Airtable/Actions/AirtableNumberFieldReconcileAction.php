<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableNumberFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtableNumberField;
use App\Modules\Airtable\Models\AirtableField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableNumberFieldReconcileAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableNumberFieldResourceResponseDto $numberFieldResourceResponseDto, AirtableField $field):  AirtableNumberField
    {
        Log::info('executing AirtableNumberFieldReconcileAction', ['numberFieldResourceResponseDto' => $numberFieldResourceResponseDto, 'field' => $field]);

        $numberField = $field->numberField()->updateOrCreate(
            [],
            $numberFieldResourceResponseDto->options->toArray(),
        );
        Log::notice('created or updated AirtableNumberField', ['numberField' => $numberField, 'numberFieldResourceResponseDto' => $numberFieldResourceResponseDto]);

        return $numberField;
    }
}
