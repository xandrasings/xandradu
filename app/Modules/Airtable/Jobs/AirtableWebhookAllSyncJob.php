<?php

namespace App\Modules\Airtable\Jobs;

use App\Modules\Airtable\Models\AirtableBase;
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

    protected ?AirtableBase $base;

    public function __construct(?AirtableBase $base = null)
    {
        $this->base = $base;
    }

    /**
     * @throws Exception
     */
    public function handle(): void
    {
        if (is_null($this->base)) {
            AirtableBase::all()->each(function (AirtableBase $base) {
                dispatch(new AirtableWebhookAllSyncJob($base));
            });
        } else {
            Bus::chain([
                new AirtableWebhookAllSyncDownJob($this->base),
                new AirtableWebhookAllSyncUpJob($this->base),
            ])->dispatch();
        }
    }
}
