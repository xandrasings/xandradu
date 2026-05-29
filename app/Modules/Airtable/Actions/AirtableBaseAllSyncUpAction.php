<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Models\AirtableBase;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableBaseAllSyncUpAction
{
    protected AirtableBaseExpressAction $baseExpressAction;

    public function __construct()
    {
        $this->baseExpressAction = app(AirtableBaseExpressAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(): void
    {
        Log::info('executing AirtableBaseAllSyncUpAction');

        AirtableBase::withTrashed()->get()
            ->each(function (AirtableBase $base) {
                $this->baseExpressAction->handle($base);
            });
    }
}
