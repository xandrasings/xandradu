<?php

namespace App\Modules\Airtable\Clients;

use App\Modules\Airtable\Dtos\AirtableBaseCreateRequestDto;
use App\Modules\Airtable\Dtos\AirtableBaseCreateResponseDto;
use App\Modules\Airtable\Dtos\AirtableBaseListResponseDto;
use App\Modules\Airtable\Dtos\AirtableRecordListResponseDto;
use App\Modules\Airtable\Dtos\AirtableTableResourceListResponseDto;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AirtableClient
{
    private string $baseUrl;

    private string $bearerToken;

    private string $metaPath;

    private string $basesPath;

    private string $tablesPath;

    public function __construct()
    {
        $this->baseUrl = config('services.airtable.base_url');
        $this->metaPath = config('services.airtable.meta_path');
        $this->bearerToken = config('services.airtable.bearer_token');
        $this->basesPath = config('services.airtable.bases_path');
        $this->tablesPath = config('services.airtable.tables_path');
    }

    /**
     * @throws Exception
     */
    public function listBases(): AirtableBaseListResponseDto
    {
        $url = "$this->baseUrl$this->metaPath$this->basesPath";
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
        $url = "$this->baseUrl$this->metaPath$this->basesPath";
        $token = $this->bearerToken;

        Log::notice("POST call to $url", ['baseRequest' => $baseCreateRequestDto]);
        $response = Http::withToken($token)->post($url, $baseCreateRequestDto);

        if ($response->failed()) {
            throw new Exception("api to airtable endpoint $url failed with response {$response->getStatusCode()}", ['response body', $response->body()]);
        }

        Log::notice('call results',['json'=>$response->json(), 'body'=>$response->body()]);

        return AirtableBaseCreateResponseDto::from($response->body());
    }

    /**
     * @throws Exception
     */
    public function listTables(string $baseExternalId): AirtableTableResourceListResponseDto
    {
        $url = "$this->baseUrl$this->metaPath$this->basesPath/$baseExternalId$this->tablesPath";
        $token = $this->bearerToken;

        Log::notice("GET call to $url");
        $response = Http::withToken($token)->get($url);

        if ($response->failed()) {
            throw new Exception("api to airtable endpoint $url failed with response {$response->getStatusCode()}", ['response body', $response->body()]);
        }

        return AirtableTableResourceListResponseDto::from($response->json());
    }

    /**
     * @throws Exception
     */
    public function listRecords(string $baseExternalId, string $tableExternalId): AirtableRecordListResponseDto
    {
        $url = "$this->baseUrl/$baseExternalId/$tableExternalId";
        $token = $this->bearerToken;

        Log::notice("GET call to $url");
        $response = Http::withToken($token)
            ->withQueryParameters([
                'returnFieldsByFieldId' => true,
                'recordMetadata' => 'commentCount',
            ])
            ->get($url);

        if ($response->failed()) {
            throw new Exception("api to airtable endpoint $url failed with response {$response->getStatusCode()}", ['response body', $response->body()]);
        }

        return AirtableRecordListResponseDto::from($response->json());
    }
}
