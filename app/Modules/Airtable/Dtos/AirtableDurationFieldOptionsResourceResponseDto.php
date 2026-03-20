<?php

namespace App\Modules\Airtable\Dtos;

use App\Modules\Airtable\Enums\AirtableDurationFormatEnum;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class AirtableDurationFieldOptionsResourceResponseDto extends Data
{
    #[MapOutputName('format')]
    #[WithCast(EnumCast::class, type: AirtableDurationFormatEnum::class)]
    public AirtableDurationFormatEnum $durationFormat;
}
