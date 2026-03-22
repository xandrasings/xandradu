<?php

namespace App\Modules\Airtable\Jobs;

use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Bus;

class AirtableWebhookAllSyncJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @throws Exception
     */
    public function handle(): void
    {
        Bus::chain([
//            new AirtableWebhookAllSyncDownJob, TODO
            new AirtableWebhookAllSyncUpJob,
        ])->dispatch();
    }
}
