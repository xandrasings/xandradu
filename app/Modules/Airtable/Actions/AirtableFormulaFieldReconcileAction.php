<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableFormulaFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtableField;
use App\Modules\Airtable\Models\AirtableFormulaField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableFormulaFieldReconcileAction
{

    protected AirtableFormulaFieldFieldAllReconcileAction $formulaFieldFieldAllReconcileAction;

    public function __construct()
    {
        $this->formulaFieldFieldAllReconcileAction = app(AirtableFormulaFieldFieldAllReconcileAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(AirtableFormulaFieldResourceResponseDto $formulaFieldResourceResponseDto, AirtableField $field): AirtableFormulaField
    {
        Log::info('executing AirtableFormulaFieldReconcileAction', ['formulaFieldResourceResponseDto' => $formulaFieldResourceResponseDto, 'field' => $field]);

        $formulaField = $field->formulaField()->updateOrCreate(
            [],
            $formulaFieldResourceResponseDto->options->except('isValid', 'referencedFieldIds')->toArray(),
        );
        Log::notice('created or updated AirtableFormulaField', ['formulaField' => $formulaField, 'formulaFieldResourceResponseDto' => $formulaFieldResourceResponseDto]);

        $this->formulaFieldFieldAllReconcileAction->handle($formulaFieldResourceResponseDto->options->referencedFieldIds, $formulaField);

        return $formulaField;
    }
}
