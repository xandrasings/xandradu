<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableReferencedFieldIdResourceResponseDto;
use App\Modules\Airtable\Models\AirtableUpdatedAtField;
use App\Modules\Airtable\Models\AirtableUpdatedAtFieldField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableUpdatedAtFieldFieldReconcileAction
{
    protected AirtableFieldRetrieveAction $retrieveAction;

    public function __construct()
    {
        $this->retrieveAction = app(AirtableFieldRetrieveAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(AirtableReferencedFieldIdResourceResponseDto $referencedFieldIdResourceResponseDto, AirtableUpdatedAtField $updatedAtField): ?AirtableUpdatedAtFieldField
    {
        Log::info('executing AirtableUpdatedAtFieldFieldReconcileAction', ['updatedAtFieldOptionsFieldResourceResponseDto' => $referencedFieldIdResourceResponseDto, 'updatedAtField' => $updatedAtField]);

        $referencedField = $this->retrieveAction->handle($referencedFieldIdResourceResponseDto->referencedFieldId);
        if (is_null($referencedField)) {
            Log::warning('AirtableUpdatedAtField references an unrecognized field.');

            return null;
        }

        $updatedAtFieldField = $updatedAtField->referencedFields()->updateOrCreate(
            ['referenced_field_id' => $referencedField->id],
        );
        Log::notice('created or updated AirtableUpdatedAtFieldField', ['updatedAtFieldField' => $updatedAtFieldField, 'updatedAtFieldOptionsFieldResourceResponseDto' => $referencedFieldIdResourceResponseDto]);

        return $updatedAtFieldField;
    }
}
