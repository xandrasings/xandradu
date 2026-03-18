<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableSelectionFieldResourceResponseDto;
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
    public function handle(AirtableSelectionFieldResourceResponseDto $selectionFieldResourceResponseDto, AirtableField $field):  AirtableSelectionField
    {
        Log::info('executing AirtableSelectionFieldReconcileAction', ['selectionFieldResourceResponseDto' => $selectionFieldResourceResponseDto, 'field' => $field]);

        $selectionField = $field->selectionField()->updateOrCreate(
            [],
        );
        Log::notice('created or updated AirtableSelectionField', ['selectionField' => $selectionField, 'selectionFieldResourceResponseDto' => $selectionFieldResourceResponseDto]);

        $this->selectionFieldOptionsChoiceAllReconcileAction->handle($selectionFieldResourceResponseDto->options->choices, $selectionField);

        return $selectionField;
    }
}
