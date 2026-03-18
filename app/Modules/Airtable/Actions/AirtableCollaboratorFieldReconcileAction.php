<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableCollaboratorFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtableCollaboratorField;
use App\Modules\Airtable\Models\AirtableField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableCollaboratorFieldReconcileAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableCollaboratorFieldResourceResponseDto $collaboratorFieldResourceResponseDto, AirtableField $field):  AirtableCollaboratorField
    {
        Log::info('executing AirtableCollaboratorFieldReconcileAction', ['collaboratorFieldResourceResponseDto' => $collaboratorFieldResourceResponseDto, 'field' => $field]);

        $collaboratorField = $field->collaboratorField()->updateOrCreate(
            [],
        );
        Log::notice('created or updated AirtableCollaboratorField', ['collaboratorField' => $collaboratorField, 'collaboratorFieldResourceResponseDto' => $collaboratorFieldResourceResponseDto]);

        return $collaboratorField;
    }
}
