<?php

namespace App\Modules\Airtable\Dtos;

use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class AirtableSyncSourceFieldOptionsResourceResponseDto extends Data
{
    #[DataCollectionOf(AirtableSyncSourceFieldOptionsChoiceResourceResponseDto::class)]
    public Collection $choices;
}
