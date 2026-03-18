<?php

namespace App\Modules\Airtable\Dtos;

use App\Transformers\AssertTrueTransformer;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class AirtableUpdatedAtFieldOptionsResourceResponseDto extends Data
{
    #[WithTransformer(AssertTrueTransformer::class)]
    public bool $isValid;

    public ?AirtableUpdatedAtFieldOptionsResultResourceResponseDto $result;
}
