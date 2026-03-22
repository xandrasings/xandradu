<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Clients\AirtableWebhookClient;
use App\Modules\Airtable\Dtos\AirtableWebhookCreateRequestDto;
use App\Modules\Airtable\Models\AirtableWebhook;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableWebhookCreateAction
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
        Log::info('executing AirtableWebhookCreateAction'); // TODO , ['webhook' => $webhook]

        $webhookCreateResponseDto = $this->client->createWebhook(new AirtableWebhookCreateRequestDto(), $webhook->base->external_id);

        $webhook->update($webhookCreateResponseDto->toArray());
        Log::notice('updated AirtableWebhook with external_id', ['webhook' => $webhook, 'webhookCreateResponseDto' => $webhookCreateResponseDto]);
    }
}
