<?php

namespace App\Modules\Airtable\Dtos;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Illuminate\Support\Collection;

class AirtableBaseListResponseDto extends Data
{
    public function __construct(

        #[DataCollectionOf(AirtableBaseResourceResponseDto::class)]
        public Collection $bases,
    )
    {}
}
