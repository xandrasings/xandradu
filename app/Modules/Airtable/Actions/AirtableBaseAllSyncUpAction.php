<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Models\AirtableBase;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableBaseAllSyncUpAction
{
    protected AirtableBaseManifestAction $baseManifestAction;

    public function __construct()
    {
        $this->baseManifestAction = app(AirtableBaseManifestAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(): void
    {
        Log::info('executing AirtableBaseSyncUpAllAction');

        AirtableBase::withTrashed()->get()
            ->each( function (AirtableBase $base) {
                $this->baseManifestAction->handle($base);
            });
    }
}
