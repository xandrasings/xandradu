<?php

namespace App\Modules\Airtable\Jobs;

use App\Modules\Airtable\Actions\AirtableRecordAllSyncDownAction;
use App\Modules\Airtable\Models\AirtableTable;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AirtableRecordAllSyncDownJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected AirtableRecordAllSyncDownAction $recordAllSyncDownAction;

    protected AirtableTable $table;

    public function __construct(AirtableTable $table)
    {
        $this->recordAllSyncDownAction = app(AirtableRecordAllSyncDownAction::class);
        $this->table = $table;
    }

    /**
     * @throws Exception
     */
    public function handle(): void
    {
        $this->recordAllSyncDownAction->handle($this->table);
    }
}
