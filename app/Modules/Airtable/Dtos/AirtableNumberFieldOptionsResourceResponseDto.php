<?php

namespace App\Modules\Airtable\Dtos;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\Between;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class AirtableNumberFieldOptionsResourceResponseDto extends Data
{
    #[Between(0, 8)]
    public int $precision;
}
