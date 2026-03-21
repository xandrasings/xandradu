<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Models\AirtableRecord;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class AirtableRecordAllTrashAction
{
    protected AirtableRecordTrashAction $recordTrashAction;

    public function __construct()
    {
        $this->recordTrashAction = app(AirtableRecordTrashAction::class);
    }

    /**
     * @param  Collection<AirtableRecord>  $records
     *
     * @throws Exception
     */
    public function handle(Collection $records): void
    {
        Log::info('executing AirtableRecordAllTrashAction');

        $records
            ->each(function (AirtableRecord $record) {
                $this->recordTrashAction->handle($record);
            });
    }
}
