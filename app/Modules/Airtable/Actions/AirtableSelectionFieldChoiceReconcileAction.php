<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableSelectionFieldOptionsChoiceResourceResponseDto;
use App\Modules\Airtable\Models\AirtableSelectionField;
use App\Modules\Airtable\Models\AirtableSelectionFieldChoice;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableSelectionFieldChoiceReconcileAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableSelectionFieldOptionsChoiceResourceResponseDto $selectionFieldOptionsChoiceResourceResponseDto, AirtableSelectionField $selectionField): AirtableSelectionFieldChoice
    {
        Log::info('executing AirtableSelectionFieldChoiceReconcileAction', ['selectionFieldOptionsChoiceResourceResponseDto' => $selectionFieldOptionsChoiceResourceResponseDto, 'selectionField' => $selectionField]);

        $selectionFieldChoice = $selectionField->choices()->updateOrCreate(
            $selectionFieldOptionsChoiceResourceResponseDto->only('id')->toArray(),
            $selectionFieldOptionsChoiceResourceResponseDto->except('id')->toArray(),
        );
        Log::notice('created or updated AirtableSelectionFieldChoice', ['selectionFieldChoice' => $selectionFieldChoice, 'selectionFieldOptionsChoiceResourceResponseDto' => $selectionFieldOptionsChoiceResourceResponseDto]);

        return $selectionFieldChoice;
    }

}
