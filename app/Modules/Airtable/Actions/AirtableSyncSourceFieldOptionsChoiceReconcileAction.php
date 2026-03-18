<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableSyncSourceFieldOptionsChoiceResourceResponseDto;
use App\Modules\Airtable\Models\AirtableSyncSourceField;
use App\Modules\Airtable\Models\AirtableSyncSourceFieldChoice;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableSyncSourceFieldOptionsChoiceReconcileAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableSyncSourceFieldOptionsChoiceResourceResponseDto $syncSourceFieldOptionsChoiceResourceResponseDto, AirtableSyncSourceField $syncSourceField): AirtableSyncSourceFieldChoice
    {
        Log::info('executing AirtableSyncSourceFieldOptionsChoiceReconcileAction', ['syncSourceFieldOptionsChoiceResourceResponseDto' => $syncSourceFieldOptionsChoiceResourceResponseDto, 'syncSourceField' => $syncSourceField]);

        $syncSourceFieldChoice = $syncSourceField->choices()->updateOrCreate(
            $syncSourceFieldOptionsChoiceResourceResponseDto->only('id')->toArray(),
            $syncSourceFieldOptionsChoiceResourceResponseDto->except('id')->toArray(),
        );
        Log::notice('created or updated AirtableSyncSourceFieldChoice', ['syncSourceFieldChoice' => $syncSourceFieldChoice, 'syncSourceFieldOptionsChoiceResourceResponseDto' => $syncSourceFieldOptionsChoiceResourceResponseDto]);

        return $syncSourceFieldChoice;
    }
}
