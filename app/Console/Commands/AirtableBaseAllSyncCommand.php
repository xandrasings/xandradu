<?php

namespace App\Console\Commands;

use App\Modules\Airtable\Jobs\AirtableBaseAllSyncJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class AirtableBaseAllSyncCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:airtable-base-all-sync-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run job to sync Airtable';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        dispatch(new AirtableBaseAllSyncJob);

        print_r("CONSOLE COMMAND COMPLETED: $this->signature\n");
        Log::notice("CONSOLE COMMAND COMPLETED: $this->signature");
    }
}
