<?php

namespace App\Modules\Airtable\Jobs;

use App\Modules\Airtable\Actions\AirtableBaseAllSyncUpAction;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AirtableBaseAllSyncUpJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected AirtableBaseAllSyncUpAction $baseAllSyncUpAction;

    public function __construct()
    {
        $this->baseAllSyncUpAction = app(AirtableBaseAllSyncUpAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(): void
    {
        $this->baseAllSyncUpAction->handle();
    }
}
