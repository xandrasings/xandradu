<?php

namespace App\Modules\Airtable\Dtos;

use App\Modules\Airtable\Enums\AirtableDateTimeTypeEnum;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\PropertyForMorph;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Contracts\PropertyMorphableData;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
abstract class AirtableCreatedAtFieldOptionsResultResourceResponseDto extends Data implements PropertyMorphableData
{
    #[PropertyForMorph]
    #[WithCast(EnumCast::class, type: AirtableDateTimeTypeEnum::class)]
    public AirtableDateTimeTypeEnum $type;

    public static function morph(array $properties): ?string
    {
        return match ($properties['type']) {
            AirtableDateTimeTypeEnum::DATE => AirtableCreatedAtFieldOptionsDateResultResourceResponseDto::class,
            AirtableDateTimeTypeEnum::DATE_TIME => AirtableCreatedAtFieldOptionsDateTimeResultResourceResponseDto::class
        };
    }
}
