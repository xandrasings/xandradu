<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableSelectionFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtableField;
use App\Modules\Airtable\Models\AirtableSelectionField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableSelectionFieldReconcileAction
{
    protected AirtableSelectionFieldChoiceAllReconcileAction $selectionFieldChoiceAllReconcileAction;

    public function __construct()
    {
        $this->selectionFieldChoiceAllReconcileAction = app(AirtableSelectionFieldChoiceAllReconcileAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(AirtableSelectionFieldResourceResponseDto $selectionFieldResourceResponseDto, AirtableField $field): AirtableSelectionField
    {
        Log::info('executing AirtableSelectionFieldReconcileAction', ['selectionFieldResourceResponseDto' => $selectionFieldResourceResponseDto, 'field' => $field]);

        $selectionField = $field->selectionField()->updateOrCreate(
            [],
        );
        Log::notice('created or updated AirtableSelectionField', ['selectionField' => $selectionField, 'selectionFieldResourceResponseDto' => $selectionFieldResourceResponseDto]);

        $this->selectionFieldChoiceAllReconcileAction->handle($selectionFieldResourceResponseDto->options->choices, $selectionField);

        return $selectionField;
    }
}
