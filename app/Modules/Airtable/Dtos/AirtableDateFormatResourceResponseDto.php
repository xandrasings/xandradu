<?php

namespace App\Modules\Airtable\Dtos;
use App\Modules\Airtable\Enums\AirtableDateFormatFormatEnum;
use App\Modules\Airtable\Enums\AirtableDateFormatNameEnum;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class AirtableDateFormatResourceResponseDto extends Data
{
    #[WithCast(EnumCast::class, type: AirtableDateFormatNameEnum::class)]
    public AirtableDateFormatNameEnum $name;


    #[MapOutputName('date_format')]
    #[WithCast(EnumCast::class, type: AirtableDateFormatFormatEnum::class)]
    public AirtableDateFormatFormatEnum $format;
}
