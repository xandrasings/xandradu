<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Models\AirtableRecord;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableRecordTrashAction
{
    /**
     * @throws Exception
     */
    public function handle(AirtableRecord $record): void
    {
        Log::info('executing AirtableRecordTrashAction');

        $record->delete();
        Log::notice('deleted AirtableRecord.', ['record' => $record]);
    }
}
