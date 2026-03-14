<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableCollaboratorFieldResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtableCollaboratorField;
use App\Modules\Airtable\Models\AirtableField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableCollaboratorFieldReconcileAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableFieldResourceResponseDto $fieldResourceResponseDto, AirtableField $field):  AirtableCollaboratorField
    {
        Log::info('executing AirtableCollaboratorFieldReconcileAction', ['fieldResourceResponseDto' => $fieldResourceResponseDto, 'field' => $field]);

        if (!($fieldResourceResponseDto instanceof AirtableCollaboratorFieldResourceResponseDto)) {
            Log::error('Wrong field type encountered.', ['fieldResourceResponseDto' => $fieldResourceResponseDto]);
            throw new Exception('Wrong field type encountered.');
        }

        $collaboratorField = $field->collaboratorField()->updateOrCreate(
            [],
        );
        Log::notice('created or updated AirtableCollaboratorField', ['collaboratorField' => $collaboratorField, 'fieldResourceResponseDto' => $fieldResourceResponseDto]);

        return $collaboratorField;
    }
}
