<?php

namespace App\Modules\Airtable\Clients;

use App\Modules\Airtable\Dtos\AirtableWebhookCreateRequestDto;
use App\Modules\Airtable\Dtos\AirtableWebhookCreateResponseDto;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AirtableWebhookClient
{
    private string $baseUrl;

    private string $bearerToken;

    private string $basesPath;

    private string $webhooksPath;

    public function __construct()
    {
        $this->baseUrl = config('services.airtable.base_url');
        $this->bearerToken = config('services.airtable.bearer_token');
        $this->basesPath = config('services.airtable.bases_path');
        $this->webhooksPath = config('services.airtable.webhooks_path');
    }

    /**
     * @throws Exception
     */
    public function createWebhook(AirtableWebhookCreateRequestDto $webhookCreateRequestDto, string $baseExternalId): AirtableWebhookCreateResponseDto
    {
        $url = "$this->baseUrl$this->basesPath/$baseExternalId$this->webhooksPath";
        $token = $this->bearerToken;

        Log::notice("POST call to $url", ['webhookCreateRequestDto' => $webhookCreateRequestDto, 'baseExternalId' => $baseExternalId]);
        $response = Http::withToken($token)->post($url, $webhookCreateRequestDto);

        if ($response->failed()) {
            Log::error("api to airtable endpoint $url failed with response {$response->getStatusCode()}", ['response body', $response->body()]);
            throw new Exception("api to airtable endpoint $url failed with response {$response->getStatusCode()}");
        }

        Log::notice('call results',['json'=>$response->json(), 'body'=>$response->body()]);

        return AirtableWebhookCreateResponseDto::from($response->body());
    }
}
