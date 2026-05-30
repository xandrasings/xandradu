<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Models\AirtableBase;
use App\Modules\Airtable\Models\AirtableWebhook;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableWebhookAllSyncUpAction
{
    protected AirtableWebhookCreateAction $webhookCreateAction;

    protected AirtableWebhookRefreshAction $webhookRefreshAction;

    public function __construct()
    {
        $this->webhookCreateAction = app(AirtableWebhookCreateAction::class);
        $this->webhookRefreshAction = app(AirtableWebhookRefreshAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(AirtableBase $base): void
    {
        Log::info('executing AirtableWebhookAllSyncUpAction', ['base' => $base]);

        if ($base->webhooks->isEmpty()) {
            $this->webhookCreateAction->handle($base);
        } else {
            $base->webhooks->each(function (AirtableWebhook $webhook) {
                $this->webhookRefreshAction->handle($webhook);
            });
        }
    }
}
