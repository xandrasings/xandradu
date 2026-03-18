<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableSelectionsFieldResourceResponseDto;
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
    public function handle(AirtableSelectionsFieldResourceResponseDto $selectionsFieldResourceResponseDto, AirtableField $field):  AirtableSelectionsField
    {
        Log::info('executing AirtableSelectionsFieldReconcileAction', ['selectionsFieldResourceResponseDto' => $selectionsFieldResourceResponseDto, 'field' => $field]);

        $selectionsField = $field->selectionsField()->updateOrCreate(
            [],
        );
        Log::notice('created or updated AirtableSelectionsField', ['selectionsField' => $selectionsField, 'selectionsFieldResourceResponseDto' => $selectionsFieldResourceResponseDto]);

        $this->selectionsFieldOptionsChoiceAllReconcileAction->handle($selectionsFieldResourceResponseDto->options->choices, $selectionsField);

        return $selectionsField;
    }
}
