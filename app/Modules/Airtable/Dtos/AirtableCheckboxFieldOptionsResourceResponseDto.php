<?php

namespace App\Modules\Airtable\Dtos;

use App\Modules\Airtable\Enums\AirtableLimitedColorEnum;
use App\Modules\Airtable\Enums\AirtableCheckboxIconEnum;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class AirtableCheckboxFieldOptionsResourceResponseDto extends Data
{
    #[WithCast(EnumCast::class, type: AirtableCheckboxIconEnum::class)]
    public AirtableCheckboxIconEnum $icon;

    #[WithCast(EnumCast::class, type: AirtableLimitedColorEnum::class)]
    public AirtableLimitedColorEnum $color;
}
