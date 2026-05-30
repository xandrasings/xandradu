<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Clients\AirtableWebhookClient;
use App\Modules\Airtable\Models\AirtableWebhook;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableWebhookRefreshAction
{
    protected AirtableWebhookClient $client;

    public function __construct()
    {
        $this->client = app(AirtableWebhookClient::class);
    }

    /**
     * @throws Exception
     */
    public function handle(AirtableWebhook $webhook): void // TODO
    {
        Log::info('executing AirtableWebhookRefreshAction'); // TODO , ['webhook' => $webhook]

        $webhookRefreshResponseDto = $this->client->refreshWebhook($webhook->base->external_id, $webhook->external_id);

        $webhook->update($webhookRefreshResponseDto->toArray());
        Log::notice('updated AirtableWebhook', ['webhook' => $webhook, 'webhookRefreshResponseDto' => $webhookRefreshResponseDto]);
    }
}
