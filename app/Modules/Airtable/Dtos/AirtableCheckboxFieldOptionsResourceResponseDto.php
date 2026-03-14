<?php

namespace App\Modules\Airtable\Dtos;

use App\Modules\Airtable\Enums\AirtableCheckboxFieldOptionsResourceColorEnum;
use App\Modules\Airtable\Enums\AirtableCheckboxFieldOptionsResourceIconEnum;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class AirtableCheckboxFieldOptionsResourceResponseDto extends Data
{
    #[WithCast(EnumCast::class, type: AirtableCheckboxFieldOptionsResourceIconEnum::class)]
    public AirtableCheckboxFieldOptionsResourceIconEnum $icon;

    #[WithCast(EnumCast::class, type: AirtableCheckboxFieldOptionsResourceColorEnum::class)]
    public AirtableCheckboxFieldOptionsResourceColorEnum $color;
}
