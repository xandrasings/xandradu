<?php

namespace App\Modules\Airtable\Jobs;

use App\Modules\Airtable\Actions\AirtableBaseSyncUpAllAction;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class AirtableSyncTablesJob implements ShouldQueue
{
    use Queueable;

    protected AirtableBaseSyncUpAllAction $baseSyncUpAllAction;

    public function __construct()
    {
        $this->baseSyncUpAllAction = app(AirtableBaseSyncUpAllAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(): void
    {
        $this->baseSyncUpAllAction->handle();
    }
}
