<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableSyncSourceFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtableField;
use App\Modules\Airtable\Models\AirtableSyncSourceField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableSyncSourceFieldReconcileAction
{
    protected AirtableSyncSourceFieldChoiceAllReconcileAction $syncSourceFieldChoiceAllReconcileAction;

    public function __construct()
    {
        $this->syncSourceFieldChoiceAllReconcileAction = app(AirtableSyncSourceFieldChoiceAllReconcileAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(AirtableSyncSourceFieldResourceResponseDto $syncSourceFieldResourceResponseDto, AirtableField $field): AirtableSyncSourceField
    {
        Log::info('executing AirtableSyncSourceFieldReconcileAction', ['syncSourceFieldResourceResponseDto' => $syncSourceFieldResourceResponseDto, 'field' => $field]);

        $syncSourceField = $field->syncSourceField()->updateOrCreate(
            [],
        );
        Log::notice('created or updated AirtableSyncSourceField', ['syncSourceField' => $syncSourceField, 'syncSourceFieldResourceResponseDto' => $syncSourceFieldResourceResponseDto]);

        $this->syncSourceFieldChoiceAllReconcileAction->handle($syncSourceFieldResourceResponseDto->options->choices, $syncSourceField);

        return $syncSourceField;
    }
}
