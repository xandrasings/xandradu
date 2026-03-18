<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableAiTextFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtableAiTextField;
use App\Modules\Airtable\Models\AirtableField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableAiTextFieldReconcileAction
{
    protected AirtableAiTextFieldPromptComponentAllReconcileAction $aiTextFieldPromptComponentAllReconcileAction;

    public function __construct()
    {
        $this->aiTextFieldPromptComponentAllReconcileAction = app(AirtableAiTextFieldPromptComponentAllReconcileAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(AirtableAiTextFieldResourceResponseDto $aiTextFieldResourceResponseDto, AirtableField $field):  AirtableAiTextField
    {
        Log::info('executing AirtableAiTextFieldReconcileAction', ['aiTextFieldResourceResponseDto' => $aiTextFieldResourceResponseDto, 'field' => $field]);

        $aiTextField = $field->aiTextField()->updateOrCreate(
            [],
        );
        Log::notice('created or updated AirtableAiTextField', ['aiTextField' => $aiTextField, 'aiTextFieldResourceResponseDto' => $aiTextFieldResourceResponseDto]);

        $this->aiTextFieldPromptComponentAllReconcileAction->handle($aiTextFieldResourceResponseDto->options->prompt, $aiTextField);

        return $aiTextField;
    }
}
