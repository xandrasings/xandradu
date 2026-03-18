<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Models\AirtableSelectionFieldChoice;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableSelectionFieldChoiceTrashAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableSelectionFieldChoice $selectionFieldChoice): void
    {
        Log::info('executing AirtableSelectionFieldChoiceTrashAction');

        $selectionFieldChoice->rank = 0;
        $selectionFieldChoice->save();
        Log::notice('unranked AirtableSelectionFieldChoice.', ['selectionFieldChoice' => $selectionFieldChoice]);

        $selectionFieldChoice->delete();
        Log::notice('deleted AirtableSelectionFieldChoice.', ['selectionFieldChoice' => $selectionFieldChoice]);
    }
}
