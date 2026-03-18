<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableAiTextFieldOptionsPromptComponentResourceResponseDto;
use App\Modules\Airtable\Enums\AirtableAiTextFieldOptionsPromptComponentTypeEnum;
use App\Modules\Airtable\Models\AirtableAiTextField;
use App\Modules\Airtable\Models\AirtableAiTextFieldPromptComponent;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableAiTextFieldPromptComponentReconcileAction
{
    protected AirtableAiTextFieldFieldPromptComponentReconcileAction $aiTextFieldFieldPromptComponentReconcileAction;

    protected AirtableAiTextFieldTextPromptComponentReconcileAction $aiTextFieldTextPromptComponentReconcileAction;

    public function __construct()
    {
        $this->aiTextFieldFieldPromptComponentReconcileAction = app(AirtableAiTextFieldFieldPromptComponentReconcileAction::class);

        $this->aiTextFieldTextPromptComponentReconcileAction = app(AirtableAiTextFieldTextPromptComponentReconcileAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(AirtableAiTextFieldOptionsPromptComponentResourceResponseDto $aiTextFieldOptionsPromptComponentResourceResponseDto, AirtableAiTextField $aiTextField): AirtableAiTextFieldPromptComponent
    {
        Log::info('executing AirtableAiTextFieldPromptComponentReconcileAction', ['aiTextFieldOptionsPromptComponentResourceResponseDto' => $aiTextFieldOptionsPromptComponentResourceResponseDto, 'aiTextField' => $aiTextField]);

        $aiTextFieldPromptComponent = $aiTextField->promptComponents()->updateOrCreate(
            $aiTextFieldOptionsPromptComponentResourceResponseDto->only('rank')->toArray(),
            $aiTextFieldOptionsPromptComponentResourceResponseDto->except('rank')->toArray(),
        );
        Log::notice('created or updated AirtableAiTextFieldPromptComponent', ['aiTextFieldPromptComponent' => $aiTextFieldPromptComponent, 'aiTextFieldOptionsPromptComponentResourceResponseDto' => $aiTextFieldOptionsPromptComponentResourceResponseDto]);

        $aiTextFieldOptionsPromptComponentResourceResponseDto->type->validate($aiTextFieldOptionsPromptComponentResourceResponseDto);
        match ($aiTextFieldOptionsPromptComponentResourceResponseDto->type) {
            AirtableAiTextFieldOptionsPromptComponentTypeEnum::FIELD => $this->aiTextFieldFieldPromptComponentReconcileAction->handle($aiTextFieldOptionsPromptComponentResourceResponseDto, $aiTextFieldPromptComponent),
            AirtableAiTextFieldOptionsPromptComponentTypeEnum::TEXT => $this->aiTextFieldTextPromptComponentReconcileAction->handle($aiTextFieldOptionsPromptComponentResourceResponseDto, $aiTextFieldPromptComponent),
        };

        return $aiTextFieldPromptComponent;
    }
}
