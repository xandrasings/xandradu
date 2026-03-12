<?php

namespace App\Modules\Airtable\Dtos;

use App\Modules\Airtable\Enums\AirtableOptionsResourceColorEnum;
use App\Modules\Airtable\Enums\AirtableOptionsResourceIconEnum;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

final class AirtableOptionsResourceResponseDto extends Data
{
    public function __construct(
        #[WithCast(EnumCast::class, type: AirtableOptionsResourceIconEnum::class)]
        public AirtableOptionsResourceIconEnum|Optional $icon,

        #[WithCast(EnumCast::class, type: AirtableOptionsResourceColorEnum::class)]
        public AirtableOptionsResourceColorEnum|Optional $color,
    )
    {}
}
