<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Models\AirtableAiTextFieldPromptComponent;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class AirtableAiTextFieldPromptComponentAllTrashAction
{
    protected AirtableAiTextFieldPromptComponentTrashAction $aiTextFieldPromptComponentTrashAction;

    public function __construct()
    {
        $this->aiTextFieldPromptComponentTrashAction = app(AirtableAiTextFieldPromptComponentTrashAction::class);
    }

    /**
     * @param Collection<AirtableAiTextFieldPromptComponent> $aiTextFieldPromptComponents
     * @throws Exception
     */
    public function handle(Collection $aiTextFieldPromptComponents): void
    {
        Log::info('executing AirtableAiTextFieldPromptComponentAllTrashAction');

        $aiTextFieldPromptComponents->each(function (AirtableAiTextFieldPromptComponent $aiTextFieldPromptComponent) {
            $this->aiTextFieldPromptComponentTrashAction->handle($aiTextFieldPromptComponent);
        });
    }
}
