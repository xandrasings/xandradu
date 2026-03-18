<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Models\AirtableAiTextFieldPromptComponent;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableAiTextFieldPromptComponentTrashAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableAiTextFieldPromptComponent $aiTextFieldPromptComponent): void
    {
        Log::info('executing AirtableAiTextFieldPromptComponentTrashAction');

        $aiTextFieldPromptComponent->rank = 0;
        $aiTextFieldPromptComponent->save();
        Log::notice('unranked AirtableAiTextFieldPromptComponent.', ['aiTextFieldPromptComponent' => $aiTextFieldPromptComponent]);

        $aiTextFieldPromptComponent->delete();
        Log::notice('deleted AirtableAiTextFieldPromptComponent.', ['aiTextFieldPromptComponent' => $aiTextFieldPromptComponent]);
    }
}
