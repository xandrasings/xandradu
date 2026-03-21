<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableLookupFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtableField;
use App\Modules\Airtable\Models\AirtableLookupField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableLookupFieldReconcileAction
{
    protected AirtableFieldRetrieveAction $retrieveAction;

    public function __construct()
    {
        $this->retrieveAction = app(AirtableFieldRetrieveAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(AirtableLookupFieldResourceResponseDto $lookupFieldResourceResponseDto, AirtableField $field): AirtableLookupField
    {
        Log::info('executing AirtableLookupFieldReconcileAction', ['lookupFieldResourceResponseDto' => $lookupFieldResourceResponseDto, 'field' => $field]);

        $referencedField = $this->retrieveAction->handle($lookupFieldResourceResponseDto->options->recordLinkFieldId);
        if (is_null($referencedField)) {
            Log::warning('AirtableLookupField references an unrecognized field.');
        }

        $targetedField = $this->retrieveAction->handle($lookupFieldResourceResponseDto->options->fieldIdInLinkedTable);
        if (is_null($targetedField)) {
            Log::warning('AirtableLookupField references an unrecognized field.');
        }

        $lookupField = $field->lookupField()->updateOrCreate(
            [],
            [
                'referenced_field_id' => is_null($referencedField) ? null : $referencedField->id,
                'targeted_field_id' => is_null($targetedField) ? null : $targetedField->id,
            ],
        );
        Log::notice('created or updated AirtableLookupField', ['lookupField' => $lookupField, 'lookupFieldResourceResponseDto' => $lookupFieldResourceResponseDto]);

        return $lookupField;
    }
}
