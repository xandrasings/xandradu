<?php

namespace App\Modules\Airtable\Jobs;

use App\Modules\Airtable\Actions\AirtableBaseAllSyncDownAction;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AirtableBaseAllSyncDownJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected AirtableBaseAllSyncDownAction $baseAllSyncDownAction;

    public function __construct()
    {
        $this->baseAllSyncDownAction = app(AirtableBaseAllSyncDownAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(): void
    {
        $this->baseAllSyncDownAction->handle();
    }
}
