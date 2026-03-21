<?php

namespace App\Modules\Airtable\Dtos;

use App\Modules\Airtable\Enums\AirtableTimeFormatEnum;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class AirtableTimeFormatResourceResponseDto extends Data
{
    #[MapOutputName('time_format')]
    #[WithCast(EnumCast::class, type: AirtableTimeFormatEnum::class)]
    public AirtableTimeFormatEnum $format;
}
