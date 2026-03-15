<?php

namespace App\Modules\Airtable\Dtos;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class AirtableBaseListResponseDto extends Data
{
    #[DataCollectionOf(AirtableBaseResourceResponseDto::class)]
    public Collection $bases;
}
