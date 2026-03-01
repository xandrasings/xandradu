<?php

namespace App\Modules\Airtable\Clients;

use App\Modules\Airtable\Dtos\AirtableBaseCreateRequestDto;
use App\Modules\Airtable\Dtos\AirtableBaseCreateResponseDto;
use App\Modules\Airtable\Dtos\AirtableBaseListResponseDto;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AirtableClient
{
    private string $baseUrl;

    private string $bearerToken;
    private string $basesPath;

    public function __construct()
    {
        $this->baseUrl = config('services.airtable.base_url');
        $this->bearerToken = config('services.airtable.bearer_token');
        $this->basesPath = config('services.airtable.bases_path');
    }

    /**
     * @throws Exception
     */
    public function listBases(): AirtableBaseListResponseDto
    {
        $url = $this->baseUrl.$this->basesPath;
        $token = $this->bearerToken;

        Log::notice("GET call to $url");
        $response = Http::withToken($token)->get($url);

        if ($response->failed()) {
            throw new Exception("api to airtable endpoint $url failed with response {$response->getStatusCode()}", ['response body', $response->body()]);
        }

        return AirtableBaseListResponseDto::from($response->json());
    }

    /**
     * @throws Exception
     */
    public function createBase(AirtableBaseCreateRequestDto $baseCreateRequestDto): AirtableBaseCreateResponseDto
    {
        $url = $this->baseUrl.$this->basesPath;
        $token = $this->bearerToken;

        Log::notice("POST call to $url", ['baseRequest' => $baseCreateRequestDto]);
        $response = Http::withToken($token)->post($url, $baseCreateRequestDto);

        if ($response->failed()) {
            throw new Exception("api to airtable endpoint $url failed with response {$response->getStatusCode()}", ['response body', $response->body()]);
        }

        return AirtableBaseCreateResponseDto::from($response->json());
    }
}
