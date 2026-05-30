<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Clients\AirtableWebhookClient;
use App\Modules\Airtable\Models\AirtableBase;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableWebhookAllSyncDownAction
{
    protected AirtableWebhookClient $client;

    protected AirtableWebhookAllReconcileAction $webhookAllReconcileAction;

    public function __construct()
    {
        $this->client = app(AirtableWebhookClient::class);

        $this->webhookAllReconcileAction = app(AirtableWebhookAllReconcileAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(AirtableBase $base): void
    {
        Log::info('executing AirtableWebhookAllSyncDownAction');

        $webhookResourceListResponseDto = $this->client->listWebhooks($base->external_id);

        $this->webhookAllReconcileAction->handle($webhookResourceListResponseDto->webhooks, $base);
    }
}
