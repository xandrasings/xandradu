<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableAiTextFieldResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtableAiTextField;
use App\Modules\Airtable\Models\AirtableField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableAiTextFieldReconcileAction
{
    protected AirtableAiTextFieldOptionsPromptComponentAllReconcileAction $aiTextFieldOptionsPromptComponentAllReconcileAction;

    public function __construct()
    {
        $this->aiTextFieldOptionsPromptComponentAllReconcileAction = app(AirtableAiTextFieldOptionsPromptComponentAllReconcileAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(AirtableFieldResourceResponseDto $fieldResourceResponseDto, AirtableField $field):  AirtableAiTextField
    {
        Log::info('executing AirtableAiTextFieldReconcileAction', ['fieldResourceResponseDto' => $fieldResourceResponseDto, 'field' => $field]);

        if (!($fieldResourceResponseDto instanceof AirtableAiTextFieldResourceResponseDto)) {
            Log::error('Wrong field type encountered.', ['fieldResourceResponseDto' => $fieldResourceResponseDto]);
            throw new Exception('Wrong field type encountered.');
        }

        $aiTextField = $field->aiTextField()->updateOrCreate(
            [],
        );
        Log::notice('created or updated AirtableAiTextField', ['aiTextField' => $aiTextField, 'fieldResourceResponseDto' => $fieldResourceResponseDto]);

        $this->aiTextFieldOptionsPromptComponentAllReconcileAction->handle($fieldResourceResponseDto->options->prompt, $aiTextField);

        return $aiTextField;
    }
}
