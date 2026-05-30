<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Clients\AirtableWebhookClient;
use App\Modules\Airtable\Dtos\AirtableWebhookCreateRequestDto;
use App\Modules\Airtable\Models\AirtableBase;
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
    public function handle(AirtableBase $base): void
    {
        Log::info('executing AirtableWebhookCreateAction', ['base' => $base]);

        $webhookCreateResponseDto = $this->client->createWebhook(new AirtableWebhookCreateRequestDto, $base->external_id);

        $webhook = $base->webhooks()->create($webhookCreateResponseDto->toArray());
        Log::notice('created AirtableWebhook', ['webhook' => $webhook, 'webhookCreateResponseDto' => $webhookCreateResponseDto]);
    }
}
