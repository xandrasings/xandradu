<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableCountFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtableCountField;
use App\Modules\Airtable\Models\AirtableField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableCountFieldReconcileAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableCountFieldResourceResponseDto $countFieldResourceResponseDto, AirtableField $field): AirtableCountField
    {
        Log::info('executing AirtableCountFieldReconcileAction', ['countFieldResourceResponseDto' => $countFieldResourceResponseDto, 'field' => $field]);

        $referencedField = AirtableField::where('external_id', $countFieldResourceResponseDto->options->recordLinkFieldId)->first();
        if (is_null($referencedField)) {
            Log::warning('AirtableCountField references an unrecognized field.');
        }

        $countField = $field->countField()->updateOrCreate(
            [],
            ['referenced_field_id' => is_null($referencedField) ? null : $referencedField->id],
        );
        Log::notice('created or updated AirtableCountField', ['countField' => $countField, 'countFieldResourceResponseDto' => $countFieldResourceResponseDto]);

        return $countField;
    }
}
