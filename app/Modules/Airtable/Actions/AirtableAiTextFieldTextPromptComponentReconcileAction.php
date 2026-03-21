<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableAiTextFieldOptionsTextPromptComponentResourceResponseDto;
use App\Modules\Airtable\Models\AirtableAiTextFieldPromptComponent;
use App\Modules\Airtable\Models\AirtableAiTextFieldTextPromptComponent;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableAiTextFieldTextPromptComponentReconcileAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableAiTextFieldOptionsTextPromptComponentResourceResponseDto $aiTextFieldOptionsTextPromptComponentResourceResponseDto, AirtableAiTextFieldPromptComponent $aiTextFieldPromptComponent): AirtableAiTextFieldTextPromptComponent
    {
        Log::info('executing AirtableAiTextFieldTextPromptComponentReconcileAction', ['aiTextFieldOptionsTextPromptComponentResourceResponseDto' => $aiTextFieldOptionsTextPromptComponentResourceResponseDto, 'aiTextFieldPromptComponent' => $aiTextFieldPromptComponent]);

        $aiTextFieldTextPromptComponent = $aiTextFieldPromptComponent->textPromptComponent()->updateOrCreate(
            [],
            $aiTextFieldOptionsTextPromptComponentResourceResponseDto->toArray(),
        );
        Log::notice('created or updated AirtableAiTextFieldTextPromptComponent', ['aiTextFieldPromptComponent' => $aiTextFieldPromptComponent, 'aiTextFieldPromptComponentResourceResponseDto' => $aiTextFieldOptionsTextPromptComponentResourceResponseDto]);

        return $aiTextFieldTextPromptComponent;
    }
}
