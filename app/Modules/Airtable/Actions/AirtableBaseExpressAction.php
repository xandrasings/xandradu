<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Models\AirtableBase;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableBaseExpressAction
{
    protected AirtableBaseManifestAction $baseManifestAction;

    public function __construct()
    {
        $this->baseManifestAction = app(AirtableBaseManifestAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(AirtableBase $base): void
    {
        Log::info('executing AirtableBaseExpressAction', ['base' => $base]);

        switch ($base) {
            case $base->trashed():
                Log::warning('Unable to delete base - airtable lacks this public API functionality.', ['base' => $base]);
                break;
            case is_null($base->external_id):
                $this->baseManifestAction->handle($base);
                break;
            default:
                Log::warning('Unable to update base - airtable lacks this public API functionality.', ['base' => $base]);
                break;
        }
    }
}
