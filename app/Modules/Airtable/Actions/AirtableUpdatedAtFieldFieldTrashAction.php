<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Models\AirtableAiTextFieldPromptComponent;
use App\Modules\Airtable\Models\AirtableUpdatedAtFieldField;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableUpdatedAtFieldFieldTrashAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableUpdatedAtFieldField $updatedAtFieldField): void
    {
        Log::info('executing AirtableUpdatedAtFieldFieldTrashAction');

        $updatedAtFieldField->delete();
        Log::notice('deleted AirtableUpdatedAtFieldField.', ['updatedAtFieldField' => $updatedAtFieldField]);
    }
}
