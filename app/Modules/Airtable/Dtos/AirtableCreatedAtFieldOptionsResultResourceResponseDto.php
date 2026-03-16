<?php

namespace App\Modules\Airtable\Dtos;

use App\Modules\Airtable\Enums\AirtableCreatedAtFieldOptionsResultResourceTypeEnum;
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
    #[WithCast(EnumCast::class, type: AirtableCreatedAtFieldOptionsResultResourceTypeEnum::class)]
    public AirtableCreatedAtFieldOptionsResultResourceTypeEnum $type;

    public static function morph(array $properties): ?string
    {
        return match ($properties['type']) {
            AirtableCreatedAtFieldOptionsResultResourceTypeEnum::DATE => AirtableCreatedAtFieldOptionsDateResultResourceResponseDto::class,
            AirtableCreatedAtFieldOptionsResultResourceTypeEnum::DATE_TIME => AirtableCreatedAtFieldOptionsDateTimeResultResourceResponseDto::class
        };
    }
}
