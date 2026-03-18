<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Models\AirtableSyncSourceFieldChoice;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableSyncSourceFieldChoiceTrashAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableSyncSourceFieldChoice $syncSourceFieldChoice): void
    {
        Log::info('executing AirtableSyncSourceFieldChoiceTrashAction');

        $syncSourceFieldChoice->rank = 0;
        $syncSourceFieldChoice->save();
        Log::notice('unranked AirtableSyncSourceFieldChoice.', ['syncSourceFieldChoice' => $syncSourceFieldChoice]);

        $syncSourceFieldChoice->delete();
        Log::notice('deleted AirtableSyncSourceFieldChoice.', ['syncSourceFieldChoice' => $syncSourceFieldChoice]);
    }
}
