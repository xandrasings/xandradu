<?php

namespace App\Modules\Airtable\Dtos;

use App\Modules\Airtable\Enums\AirtableViewTypeEnum;
use App\Transformers\ShortenLengthyStringTransformer;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class AirtableViewResourceResponseDto extends Data
{
    public int $rank = 0;

    #[MapOutputName('external_id')]
    public string $id;

    #[WithTransformer(ShortenLengthyStringTransformer::class, length: 32)]
    public string $name;

    #[WithCast(EnumCast::class, type: AirtableViewTypeEnum::class)]
    public AirtableViewTypeEnum $type;
}
