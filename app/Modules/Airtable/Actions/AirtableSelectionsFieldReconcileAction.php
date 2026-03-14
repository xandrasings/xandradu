<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableSelectionsFieldResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtableSelectionsField;
use App\Modules\Airtable\Models\AirtableField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableSelectionsFieldReconcileAction
{
    protected AirtableSelectionsFieldOptionsChoiceAllReconcileAction $selectionsFieldOptionsChoiceAllReconcileAction;

    public function __construct()
    {
        $this->selectionsFieldOptionsChoiceAllReconcileAction = app(AirtableSelectionsFieldOptionsChoiceAllReconcileAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(AirtableFieldResourceResponseDto $fieldResourceResponseDto, AirtableField $field):  AirtableSelectionsField
    {
        Log::info('executing AirtableSelectionsFieldReconcileAction', ['fieldResourceResponseDto' => $fieldResourceResponseDto, 'field' => $field]);

        if (!($fieldResourceResponseDto instanceof AirtableSelectionsFieldResourceResponseDto)) {
            Log::error('Wrong field type encountered.', ['fieldResourceResponseDto' => $fieldResourceResponseDto]);
            throw new Exception('Wrong field type encountered.');
        }

        $selectionsField = $field->selectionsField()->updateOrCreate(
            [],
        );
        Log::notice('created or updated AirtableSelectionsField', ['selectionsField' => $selectionsField, 'fieldResourceResponseDto' => $fieldResourceResponseDto]);

        $this->selectionsFieldOptionsChoiceAllReconcileAction->handle($fieldResourceResponseDto->options->choices, $selectionsField);

        return $selectionsField;
    }
}
