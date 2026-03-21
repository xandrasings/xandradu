<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableReferencedFieldIdResourceResponseDto;
use App\Modules\Airtable\Models\AirtableFormulaField;
use App\Modules\Airtable\Models\AirtableFormulaFieldField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableFormulaFieldFieldReconcileAction
{
    protected AirtableFieldRetrieveAction $retrieveAction;

    public function __construct()
    {
        $this->retrieveAction = app(AirtableFieldRetrieveAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(AirtableReferencedFieldIdResourceResponseDto $referencedFieldIdResourceResponseDto, AirtableFormulaField $formulaField): ?AirtableFormulaFieldField
    {
        Log::info('executing AirtableFormulaFieldFieldReconcileAction', ['formulaFieldOptionsFieldResourceResponseDto' => $referencedFieldIdResourceResponseDto, 'formulaField' => $formulaField]);

        $referencedField = $this->retrieveAction->handle($referencedFieldIdResourceResponseDto->referencedFieldId);
        if (is_null($referencedField)) {
            Log::warning('AirtableFormulaField references an unrecognized field.');

            return null;
        }

        $formulaFieldField = $formulaField->referencedFields()->updateOrCreate(
            ['referenced_field_id' => $referencedField->id],
        );
        Log::notice('created or updated AirtableFormulaFieldField', ['formulaFieldField' => $formulaFieldField, 'formulaFieldOptionsFieldResourceResponseDto' => $referencedFieldIdResourceResponseDto]);

        return $formulaFieldField;
    }
}
