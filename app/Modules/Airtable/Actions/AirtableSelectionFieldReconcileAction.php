<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableSelectionFieldResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtableSelectionField;
use App\Modules\Airtable\Models\AirtableField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableSelectionFieldReconcileAction
{
    protected AirtableSelectionFieldOptionsChoiceAllReconcileAction $selectionFieldOptionsChoiceAllReconcileAction;

    public function __construct()
    {
        $this->selectionFieldOptionsChoiceAllReconcileAction = app(AirtableSelectionFieldOptionsChoiceAllReconcileAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(AirtableFieldResourceResponseDto $fieldResourceResponseDto, AirtableField $field):  AirtableSelectionField
    {
        Log::info('executing AirtableSelectionFieldReconcileAction', ['fieldResourceResponseDto' => $fieldResourceResponseDto, 'field' => $field]);

        if (!($fieldResourceResponseDto instanceof AirtableSelectionFieldResourceResponseDto)) {
            Log::error('Wrong field type encountered.', ['fieldResourceResponseDto' => $fieldResourceResponseDto]);
            throw new Exception('Wrong field type encountered.');
        }

        $selectionField = $field->selectionField()->updateOrCreate(
            [],
        );
        Log::notice('created or updated AirtableSelectionField', ['selectionField' => $selectionField, 'fieldResourceResponseDto' => $fieldResourceResponseDto]);

        $this->selectionFieldOptionsChoiceAllReconcileAction->handle($fieldResourceResponseDto->options->choices, $selectionField);

        return $selectionField;
    }
}
