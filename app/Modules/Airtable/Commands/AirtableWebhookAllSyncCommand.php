<?php

namespace App\Modules\Airtable\Commands;

use App\Modules\Airtable\Jobs\AirtableWebhookAllSyncJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class AirtableWebhookAllSyncCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'airtable:webhook-all-sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run job to sync Airtable webhooks';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        dispatch(new AirtableWebhookAllSyncJob);

        print_r("CONSOLE COMMAND COMPLETED: $this->signature\n");
        Log::notice("CONSOLE COMMAND COMPLETED: $this->signature");
    }
}
