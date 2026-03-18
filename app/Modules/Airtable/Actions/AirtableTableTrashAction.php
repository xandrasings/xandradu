<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Models\AirtableTable;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableTableTrashAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableTable $table): void
    {
        Log::info('executing AirtableTableTrashAction');

        $table->rank = 0;
        $table->save();
        Log::notice('unranked AirtableTable.', ['table' => $table]);

        $table->delete();
        Log::notice('deleted AirtableTable.', ['table' => $table]);
    }
}
