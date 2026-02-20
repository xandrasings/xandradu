<?php

namespace App\Modules\Airtable\Services;

use App\Modules\Airtable\Actions\AirtableBaseSyncUpAllAction;
use App\Modules\Band\Models\Band;
use App\Modules\Band\Models\BandWiki;
use App\Modules\Notion\Models\NotionWorkspace;
use Exception;

class AirtableService
{
    protected AirtableBaseSyncUpAllAction $tablesSyncUpAction;

    public function __construct()
    {
        $this->tablesSyncUpAction = app(AirtableBaseSyncUpAllAction::class);
    }

    public function syncUpTables(): void
    {
        $this->tablesSyncUpAction->handle();
    }
}
