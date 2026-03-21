<?php

namespace App\Modules\Airtable\Dtos;

use App\Modules\Airtable\Enums\AirtableDateFormatEnum;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class AirtableDateFormatResourceResponseDto extends Data
{
    #[WithCast(EnumCast::class, type: AirtableDateFormatEnum::class)]
    public AirtableDateFormatEnum $format;
}
