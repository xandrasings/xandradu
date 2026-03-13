<?php

namespace App\Modules\Airtable\Dtos;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Illuminate\Support\Collection;

class AirtableTableListResponseDto extends Data
{
    #[DataCollectionOf(AirtableTableResourceResponseDto::class)]
    public Collection $tables;
}
