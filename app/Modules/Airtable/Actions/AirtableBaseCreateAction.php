<?php

namespace App\Modules\Airtable\Actions;




use App\Modules\Airtable\Clients\AirtableClient;
use App\Modules\Airtable\Dtos\AirtableBaseCreateRequestDto;
use App\Modules\Airtable\Models\AirtableBase;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableBaseCreateAction
{

    protected AirtableClient $client;

    public function __construct()
    {
        $this->client = app(AirtableClient::class);
    }

    /**
     * @throws Exception
     */
    public function handle(AirtableBase $base): void
    {
        Log::info('executing AirtableBaseCreateAction', ['base' => $base]);

        $baseCreateRequestDto = AirtableBaseCreateRequestDto::from($base);
        $baseCreateResponseDto = $this->client->createBase($baseCreateRequestDto);

        $base->update($baseCreateResponseDto->only('id')->toArray());
        Log::notice('updated AirtableBase with external_id', ['base' => $base, 'baseCreateResponseDto' => $baseCreateResponseDto]);

        // TODO deal with tables attribute
    }
}
