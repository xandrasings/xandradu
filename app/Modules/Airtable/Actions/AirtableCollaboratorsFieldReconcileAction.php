<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableCollaboratorsFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtableCollaboratorsField;
use App\Modules\Airtable\Models\AirtableField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableCollaboratorsFieldReconcileAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableCollaboratorsFieldResourceResponseDto $collaboratorsFieldResourceResponseDto, AirtableField $field):  AirtableCollaboratorsField
    {
        Log::info('executing AirtableCollaboratorsFieldReconcileAction', ['collaboratorsFieldResourceResponseDto' => $collaboratorsFieldResourceResponseDto, 'field' => $field]);

        $collaboratorsField = $field->collaboratorsField()->updateOrCreate(
            [],
        );
        Log::notice('created or updated AirtableCollaboratorsField', ['collaboratorsField' => $collaboratorsField, 'collaboratorsFieldResourceResponseDto' => $collaboratorsFieldResourceResponseDto]);

        return $collaboratorsField;
    }
}
