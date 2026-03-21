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

        $referencedField = AirtableField::where('external_id', $updatedAtFieldOptionsFieldResourceResponseDto->referencedFieldId)->first();
        if (is_null($referencedField)) {
            Log::warning('AirtableUpdatedAtField references an unrecognized field.');

            return null;
        }

        $updatedAtFieldField = $updatedAtField->fields()->updateOrCreate(
            ['referenced_field_id' => $referencedField->id],
        );
        Log::notice('created or updated AirtableUpdatedAtFieldField', ['updatedAtFieldField' => $updatedAtFieldField, 'updatedAtFieldOptionsFieldResourceResponseDto' => $updatedAtFieldOptionsFieldResourceResponseDto]);

        return $updatedAtFieldField;
    }
}
