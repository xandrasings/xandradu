<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Models\AirtableBase;
use Illuminate\Support\Facades\Log;

class AirtableBaseSyncUpAllAction
{
    protected AirtableBaseManifestAction $baseManifestAction;

    public function __construct()
    {
        $this->baseManifestAction = app(AirtableBaseManifestAction::class);
    }

    public function handle(): void
    {
        Log::info('executing AirtableBaseSyncUpAllAction');

        AirtableBase::withTrashed()->get()
            ->each(/**
             * @throws \Exception
             */ function (AirtableBase $base) {
                $this->baseManifestAction->handle($base);

                Log::notice("Table syncing up", ['base' => $base]);
            });
    }
}
