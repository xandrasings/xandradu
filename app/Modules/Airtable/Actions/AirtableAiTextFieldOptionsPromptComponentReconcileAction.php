<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableAiTextFieldOptionsPromptComponentResourceResponseDto;
use App\Modules\Airtable\Enums\AirtableAiTextFieldOptionsPromptComponentTypeEnum;
use App\Modules\Airtable\Models\AirtableAiTextField;
use App\Modules\Airtable\Models\AirtableAiTextFieldPromptComponent;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableAiTextFieldOptionsPromptComponentReconcileAction
{
    protected AirtableAiTextFieldOptionsFieldPromptComponentReconcileAction $aiTextFieldOptionsFieldPromptComponentReconcileAction;

    protected AirtableAiTextFieldOptionsTextPromptComponentReconcileAction $aiTextFieldOptionsTextPromptComponentReconcileAction;

    public function __construct()
    {
        $this->aiTextFieldOptionsFieldPromptComponentReconcileAction = app(AirtableAiTextFieldOptionsFieldPromptComponentReconcileAction::class);

        $this->aiTextFieldOptionsTextPromptComponentReconcileAction = app(AirtableAiTextFieldOptionsTextPromptComponentReconcileAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(AirtableAiTextFieldOptionsPromptComponentResourceResponseDto $aiTextFieldOptionsPromptComponentResourceResponseDto, AirtableAiTextField $aiTextField): AirtableAiTextFieldPromptComponent
    {
        Log::info('executing AirtableAiTextFieldOptionsPromptComponentReconcileAction', ['aiTextFieldOptionsPromptComponentResourceResponseDto' => $aiTextFieldOptionsPromptComponentResourceResponseDto, 'aiTextField' => $aiTextField]);

        $aiTextFieldPromptComponent = $aiTextField->promptComponents()->updateOrCreate(
            $aiTextFieldOptionsPromptComponentResourceResponseDto->only('rank')->toArray(),
            $aiTextFieldOptionsPromptComponentResourceResponseDto->except('rank')->toArray(),
        );
        Log::notice('created or updated AirtableAiTextFieldPromptComponent', ['aiTextFieldPromptComponent' => $aiTextFieldPromptComponent, 'aiTextFieldOptionsPromptComponentResourceResponseDto' => $aiTextFieldOptionsPromptComponentResourceResponseDto]);

        $aiTextFieldOptionsPromptComponentResourceResponseDto->type->validate($aiTextFieldOptionsPromptComponentResourceResponseDto);
        match ($aiTextFieldOptionsPromptComponentResourceResponseDto->type) {
            AirtableAiTextFieldOptionsPromptComponentTypeEnum::FIELD => $this->aiTextFieldOptionsFieldPromptComponentReconcileAction->handle($aiTextFieldOptionsPromptComponentResourceResponseDto, $aiTextFieldPromptComponent),
            AirtableAiTextFieldOptionsPromptComponentTypeEnum::TEXT => $this->aiTextFieldOptionsTextPromptComponentReconcileAction->handle($aiTextFieldOptionsPromptComponentResourceResponseDto, $aiTextFieldPromptComponent),
        };

        return $aiTextFieldPromptComponent;
    }
}
