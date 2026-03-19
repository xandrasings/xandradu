<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableUpdatedAtFieldOptionsFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtableField;
use App\Modules\Airtable\Models\AirtableUpdatedAtField;
use App\Modules\Airtable\Models\AirtableUpdatedAtFieldField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableUpdatedAtFieldFieldReconcileAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableUpdatedAtFieldOptionsFieldResourceResponseDto $updatedAtFieldOptionsFieldResourceResponseDto, AirtableUpdatedAtField $updatedAtField): ?AirtableUpdatedAtFieldField
    {
        Log::info('executing AirtableUpdatedAtFieldFieldReconcileAction', ['updatedAtFieldOptionsFieldResourceResponseDto' => $updatedAtFieldOptionsFieldResourceResponseDto, 'updatedAtField' => $updatedAtField]);

        $fieldId = $updatedAtFieldOptionsFieldResourceResponseDto->fieldId;

        $field = AirtableField::where('external_id', $fieldId)->first();
        if (is_null($field)) {
            Log::warning('AirtableUpdatedAtField references an unrecognized field.');
            return null;
        }

        $updatedAtFieldField = $updatedAtField->fields()->updateOrCreate(
            ['field_id' => $field->id],
        );
        Log::notice('created or updated AirtableUpdatedAtFieldField', ['updatedAtFieldField' => $updatedAtFieldField, 'fieldId' => $updatedAtFieldOptionsFieldResourceResponseDto]);

        return $updatedAtFieldField;
    }
}
