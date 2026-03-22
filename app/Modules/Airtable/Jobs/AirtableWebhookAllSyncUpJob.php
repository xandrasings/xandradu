<?php

namespace App\Modules\Airtable\Jobs;

use App\Modules\Airtable\Actions\AirtableWebhookAllSyncUpAction;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AirtableWebhookAllSyncUpJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected AirtableWebhookAllSyncUpAction $webhookAllSyncUpAction;

    public function __construct()
    {
        $this->webhookAllSyncUpAction = app(AirtableWebhookAllSyncUpAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(): void
    {
        $this->webhookAllSyncUpAction->handle();
    }
}
