<?php

namespace App\Modules\Airtable\Dtos;

use App\Modules\Airtable\Enums\AirtableFieldResourceTypeEnum;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Data;

final class AirtableFieldResourceResponseDto extends Data
{
    public function __construct(
        #[WithCast(EnumCast::class, type: AirtableFieldResourceTypeEnum::class)]
        public AirtableFieldResourceTypeEnum $type,

        #[MapOutputName('external_id')]
        public string $id,

        public string $name,
    )
    {}

}
