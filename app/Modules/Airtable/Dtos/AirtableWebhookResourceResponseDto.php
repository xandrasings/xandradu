<?php

namespace App\Modules\Airtable\Dtos;

use DateTime;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class AirtableWebhookResourceResponseDto extends Data
{
    #[MapOutputName('external_id')]
    public string $id;

    #[MapOutputName('expires_at')]
    #[WithCast(DateTimeInterfaceCast::class, format: "Y-m-d\TH:i:s.u\Z")]
    public ?DateTime $expirationTime;
}
