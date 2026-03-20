<?php

namespace App\Modules\Airtable\Dtos;

use App\Modules\Airtable\Enums\AirtableTimeZoneEnum;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class AirtableDateAndTimeFieldOptionsResourceResponseDto extends Data
{
    public AirtableDateFormatResourceResponseDto $dateFormat;

    public AirtableTimeFormatResourceResponseDto $timeFormat;

    #[WithCast(EnumCast::class, type: AirtableTimeZoneEnum::class)]
    public AirtableTimeZoneEnum $timeZone;
}
