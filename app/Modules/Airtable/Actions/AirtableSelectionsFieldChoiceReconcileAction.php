<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableSelectionsFieldOptionsChoiceResourceResponseDto;
use App\Modules\Airtable\Models\AirtableSelectionsField;
use App\Modules\Airtable\Models\AirtableSelectionsFieldChoice;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableSelectionsFieldChoiceReconcileAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableSelectionsFieldOptionsChoiceResourceResponseDto $selectionsFieldOptionsChoiceResourceResponseDto, AirtableSelectionsField $selectionsField): AirtableSelectionsFieldChoice
    {
        Log::info('executing AirtableSelectionsFieldChoiceReconcileAction', ['selectionsFieldOptionsChoiceResourceResponseDto' => $selectionsFieldOptionsChoiceResourceResponseDto, 'selectionsField' => $selectionsField]);

        $selectionsFieldChoice = $selectionsField->choices()->updateOrCreate(
            $selectionsFieldOptionsChoiceResourceResponseDto->only('id')->toArray(),
            $selectionsFieldOptionsChoiceResourceResponseDto->except('id')->toArray(),
        );
        Log::notice('created or updated AirtableSelectionsFieldChoice', ['selectionsFieldChoice' => $selectionsFieldChoice, 'selectionsFieldOptionsChoiceResourceResponseDto' => $selectionsFieldOptionsChoiceResourceResponseDto]);

        return $selectionsFieldChoice;
    }
}
