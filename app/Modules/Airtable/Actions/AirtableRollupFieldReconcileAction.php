<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableRollupFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtableField;
use App\Modules\Airtable\Models\AirtableRollupField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableRollupFieldReconcileAction
{
    protected AirtableFieldRetrieveAction $retrieveAction;

    public function __construct()
    {
        $this->retrieveAction = app(AirtableFieldRetrieveAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(AirtableRollupFieldResourceResponseDto $rollupFieldResourceResponseDto, AirtableField $field): AirtableRollupField
    {
        Log::info('executing AirtableRollupFieldReconcileAction', ['rollupFieldResourceResponseDto' => $rollupFieldResourceResponseDto, 'field' => $field]);

        $referencedField = $this->retrieveAction->handle($rollupFieldResourceResponseDto->options->recordLinkFieldId);
        if (is_null($referencedField)) {
            Log::warning('AirtableRollupField references an unrecognized field.');
        }

        $targetedField = $this->retrieveAction->handle($rollupFieldResourceResponseDto->options->fieldIdInLinkedTable);
        if (is_null($targetedField)) {
            Log::warning('AirtableRollupField references an unrecognized field.');
        }

        $rollupField = $field->rollupField()->updateOrCreate(
            [],
            [
                'referenced_field_id' => is_null($referencedField) ? null : $referencedField->id,
                'targeted_field_id' => is_null($targetedField) ? null : $targetedField->id,
            ],
        );
        Log::notice('created or updated AirtableRollupField', ['rollupField' => $rollupField, 'rollupFieldResourceResponseDto' => $rollupFieldResourceResponseDto]);

        return $rollupField;
    }
}
