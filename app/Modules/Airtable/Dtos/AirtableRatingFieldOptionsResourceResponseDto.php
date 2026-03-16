<?php

namespace App\Modules\Airtable\Dtos;

use App\Modules\Airtable\Enums\AirtableLimitedColorEnum;
use App\Modules\Airtable\Enums\AirtableRatingIconEnum;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\Between;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class AirtableRatingFieldOptionsResourceResponseDto extends Data
{
    #[WithCast(EnumCast::class, type: AirtableRatingIconEnum::class)]
    public AirtableRatingIconEnum $icon;

    #[WithCast(EnumCast::class, type: AirtableLimitedColorEnum::class)]
    public AirtableLimitedColorEnum $color;

    #[Between(1, 10)]
    public int $max;
}
