<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableAutoNumberFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtableAutoNumberField;
use App\Modules\Airtable\Models\AirtableField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableAutoNumberFieldReconcileAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableAutoNumberFieldResourceResponseDto $autoNumberFieldResourceResponseDto, AirtableField $field):  AirtableAutoNumberField
    {
        Log::info('executing AirtableAutoNumberFieldReconcileAction', ['autoNumberFieldResourceResponseDto' => $autoNumberFieldResourceResponseDto, 'field' => $field]);

        $autoNumberField = $field->autoNumberField()->updateOrCreate(
            [],
        );
        Log::notice('created or updated AirtableAutoNumberField', ['autoNumberField' => $autoNumberField, 'autoNumberFieldResourceResponseDto' => $autoNumberFieldResourceResponseDto]);

        return $autoNumberField;
    }
}
