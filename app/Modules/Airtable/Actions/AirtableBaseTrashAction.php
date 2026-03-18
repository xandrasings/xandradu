<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Models\AirtableBase;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableBaseTrashAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableBase $base): void
    {
        Log::info('executing AirtableBaseTrashAction');

        $base->rank = 0;
        $base->save();
        Log::notice('unranked AirtableBase.', ['base' => $base]);

        $base->delete();
        Log::notice('deleted AirtableBase.', ['base' => $base]);
    }
}
