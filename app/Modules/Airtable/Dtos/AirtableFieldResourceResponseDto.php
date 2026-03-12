<?php

namespace App\Modules\Airtable\Dtos;

use App\Modules\Airtable\Enums\AirtableFieldResourceTypeEnum;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

final class AirtableFieldResourceResponseDto extends Data
{
    public function __construct(
        #[MapOutputName('external_id')]
        public string $id,

        public string $name,

        public string|Optional $description,

        #[WithCast(EnumCast::class, type: AirtableFieldResourceTypeEnum::class)]
        public AirtableFieldResourceTypeEnum $type,

        public AirtableOptionsResourceResponseDto|Optional $options,
    )
    {}
}
