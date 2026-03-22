<?php

namespace App\Modules\Airtable\Dtos;

use App\Transformers\ShortenLengthyStringTransformer;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class AirtableTableResourceResponseDto extends Data
{
    public int $rank = 0;

    #[MapOutputName('external_id')]
    public string $id;

    #[WithTransformer(ShortenLengthyStringTransformer::class, length: 32)]
    public string $name;

    #[WithTransformer(ShortenLengthyStringTransformer::class, length: 2048)]
    public ?string $description;

    #[DataCollectionOf(AirtableFieldResourceResponseDto::class)]
    public Collection $fields;

    #[DataCollectionOf(AirtableViewResourceResponseDto::class)]
    public Collection $views;
}
