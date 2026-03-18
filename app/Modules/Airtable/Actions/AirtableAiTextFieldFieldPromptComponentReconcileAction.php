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

        $fieldExternalId = $aiTextFieldOptionsFieldPromptComponentResourceResponseDto->fieldId;

        $field = AirtableField::where('external_id', $fieldExternalId)->first();
        if (is_null($field)) {
            Log::warning('Airtable Ai Text Field references an unrecognized field.');
        }

        Log::notice('creating or updating AirtableAiTextFieldFieldPromptComponent', ['aiTextFieldPromptComponent' => $aiTextFieldPromptComponent, 'aiTextFieldOptionsFieldPromptComponentResourceResponseDto' => $aiTextFieldOptionsFieldPromptComponentResourceResponseDto, 'fieldExternalId' => $fieldExternalId, 'field'=>$field]);
        $aiTextFieldFieldPromptComponent = $aiTextFieldPromptComponent->fieldPromptComponent()->updateOrCreate(
            [],
            ['field_id' => is_null($field) ? null : $field->id],
        );
        Log::notice('created or updated AirtableAiTextFieldFieldPromptComponent', ['aiTextFieldPromptComponent' => $aiTextFieldPromptComponent, 'aiTextFieldOptionsFieldPromptComponentResourceResponseDto' => $aiTextFieldOptionsFieldPromptComponentResourceResponseDto]);

        return $aiTextFieldFieldPromptComponent;
    }
}
