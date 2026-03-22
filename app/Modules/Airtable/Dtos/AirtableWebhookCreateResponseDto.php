<?php

namespace App\Modules\Airtable\Dtos;

use App\Transformers\DecodeBase64StringTransformer;
use DateTime;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class AirtableWebhookCreateResponseDto extends Data
{
    #[MapOutputName('expires_at')]
    #[WithCast(DateTimeInterfaceCast::class)]
    public ?DateTime $expirationDate;

    #[MapOutputName('external_id')]
    public string $id;

    #[MapOutputName('mac_secret')]
    #[WithTransformer(DecodeBase64StringTransformer::class)]
    public string $macSecretBase64;
}
