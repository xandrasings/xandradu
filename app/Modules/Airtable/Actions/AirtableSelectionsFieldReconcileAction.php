<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableSelectionsFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtableSelectionsField;
use App\Modules\Airtable\Models\AirtableField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableSelectionsFieldReconcileAction
{
    protected AirtableSelectionsFieldChoiceAllReconcileAction $selectionsFieldChoiceAllReconcileAction;

    public function __construct()
    {
        $this->selectionsFieldChoiceAllReconcileAction = app(AirtableSelectionsFieldChoiceAllReconcileAction::class);
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

        $this->selectionsFieldChoiceAllReconcileAction->handle($selectionsFieldResourceResponseDto->options->choices, $selectionsField);

        return $selectionsField;
    }
}
