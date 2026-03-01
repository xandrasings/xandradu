<?php

namespace App\Modules\Airtable\Services;

use App\Modules\Airtable\Actions\AirtableBaseAllSyncDownAction;
use App\Modules\Airtable\Actions\AirtableBaseAllSyncUpAction;
use Exception;

class AirtableService
{
    protected AirtableBaseAllSyncDownAction $baseAllSyncDownAction;

    protected AirtableBaseAllSyncUpAction $baseAllSyncUpAction;

    public function __construct()
    {
        $this->baseAllSyncDownAction = app(AirtableBaseAllSyncDownAction::class);
        $this->baseAllSyncUpAction = app(AirtableBaseAllSyncUpAction::class);
    }

    /**
     * @throws Exception
     */
    public function baseAllSync(): void
    {
        $this->baseAllSyncDownAction->handle();
        $this->baseAllSyncUpAction->handle();
    }
}
