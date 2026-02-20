<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Models\AirtableBase;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableBaseManifestAction
{
    protected AirtableBaseCreateAction $baseCreateAction;

    public function __construct()
    {
        $this->baseCreateAction = app(AirtableBaseCreateAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(AirtableBase $base): void
    {
        Log::info('executing AirtableBaseManifestAction', ['base' => $base]);

        switch($base) {
            case $base->trashed():
                Log::warning('Unable to delete base - airtable lacks this public API functionality.', ['base' => $base]);
                break;
            case is_null($base->external_id):
                $this->baseCreateAction->handle($base);
                break;
            default:
                Log::warning('Unable to update base - airtable lacks this public API functionality.');
                break;
        }
    }
}
