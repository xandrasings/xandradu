<?php

namespace App\Modules\Airtable\Jobs;

use App\Modules\Airtable\Actions\AirtableTableAllSyncDownAction;
use App\Modules\Airtable\Models\AirtableBase;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AirtableTableAllSyncDownJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected AirtableTableAllSyncDownAction $tableAllSyncDownAction;

    protected AirtableBase $base;

    public function __construct(AirtableBase $base)
    {
        $this->tableAllSyncDownAction = app(AirtableTableAllSyncDownAction::class);
        $this->base = $base;
    }

    /**
     * @throws Exception
     */
    public function handle(): void
    {
        $this->tableAllSyncDownAction->handle($this->base);
    }
}
