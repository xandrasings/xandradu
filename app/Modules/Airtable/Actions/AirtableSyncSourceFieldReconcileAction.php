<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableSyncSourceFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtableSyncSourceField;
use App\Modules\Airtable\Models\AirtableField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableSyncSourceFieldReconcileAction
{
    protected AirtableSyncSourceFieldOptionsChoiceAllReconcileAction $syncSourceFieldOptionsChoiceAllReconcileAction;

    public function __construct()
    {
        $this->syncSourceFieldOptionsChoiceAllReconcileAction = app(AirtableSyncSourceFieldOptionsChoiceAllReconcileAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(AirtableSyncSourceFieldResourceResponseDto $syncSourceFieldResourceResponseDto, AirtableField $field):  AirtableSyncSourceField
    {
        Log::info('executing AirtableSyncSourceFieldReconcileAction', ['syncSourceFieldResourceResponseDto' => $syncSourceFieldResourceResponseDto, 'field' => $field]);

        $syncSourceField = $field->syncSourceField()->updateOrCreate(
            [],
        );
        Log::notice('created or updated AirtableSyncSourceField', ['syncSourceField' => $syncSourceField, 'syncSourceFieldResourceResponseDto' => $syncSourceFieldResourceResponseDto]);

        $this->syncSourceFieldOptionsChoiceAllReconcileAction->handle($syncSourceFieldResourceResponseDto->options->choices, $syncSourceField);

        return $syncSourceField;
    }
}
