<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Models\AirtableSelectionsFieldChoice;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableSelectionsFieldChoiceTrashAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableSelectionsFieldChoice $selectionsFieldChoice): void
    {
        Log::info('executing AirtableSelectionsFieldChoiceTrashAction');

        $selectionsFieldChoice->rank = 0;
        $selectionsFieldChoice->save();
        Log::notice('unranked AirtableSelectionsFieldChoice.', ['selectionsFieldChoice' => $selectionsFieldChoice]);

        $selectionsFieldChoice->delete();
        Log::notice('deleted AirtableSelectionsFieldChoice.', ['selectionsFieldChoice' => $selectionsFieldChoice]);
    }
}
