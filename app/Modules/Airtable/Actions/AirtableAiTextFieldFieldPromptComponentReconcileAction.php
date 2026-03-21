<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableAiTextFieldOptionsFieldPromptComponentResourceResponseDto;
use App\Modules\Airtable\Models\AirtableAiTextFieldFieldPromptComponent;
use App\Modules\Airtable\Models\AirtableAiTextFieldPromptComponent;
use App\Modules\Airtable\Models\AirtableField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableAiTextFieldFieldPromptComponentReconcileAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableAiTextFieldOptionsFieldPromptComponentResourceResponseDto $aiTextFieldOptionsFieldPromptComponentResourceResponseDto, AirtableAiTextFieldPromptComponent $aiTextFieldPromptComponent): AirtableAiTextFieldFieldPromptComponent
    {
        Log::info('executing AirtableAiTextFieldFieldPromptComponentReconcileAction', ['aiTextFieldOptionsFieldPromptComponentResourceResponseDto' => $aiTextFieldOptionsFieldPromptComponentResourceResponseDto, 'aiTextFieldPromptComponent' => $aiTextFieldPromptComponent]);

        $referencedField = AirtableField::where('external_id', $aiTextFieldOptionsFieldPromptComponentResourceResponseDto->referencedFieldId)->first();
        if (is_null($referencedField)) {
            Log::warning('AirtableAiTextField references an unrecognized field.');
        }

        $aiTextFieldFieldPromptComponent = $aiTextFieldPromptComponent->fieldPromptComponent()->updateOrCreate(
            [],
            ['referenced_field_id' => is_null($referencedField) ? null : $referencedField->id],
        );
        Log::notice('created or updated AirtableAiTextFieldFieldPromptComponent', ['aiTextFieldPromptComponent' => $aiTextFieldPromptComponent, 'aiTextFieldOptionsFieldPromptComponentResourceResponseDto' => $aiTextFieldOptionsFieldPromptComponentResourceResponseDto]);

        return $aiTextFieldFieldPromptComponent;
    }
}
