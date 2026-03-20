<?php

namespace App\Modules\Airtable\Dtos;

use App\Transformers\LengthyStringTransformer;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\Between;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class AirtableCurrencyFieldOptionsResourceResponseDto extends Data
{
    #[Between(0, 7)]
    public int $precision;

    #[WithTransformer(LengthyStringTransformer::class, length: 8)]
    public string $symbol;
}
