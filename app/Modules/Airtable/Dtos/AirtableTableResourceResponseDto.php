<?php

namespace App\Modules\Airtable\Dtos;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;
use Illuminate\Support\Collection;

final class AirtableTableResourceResponseDto extends Data
{
    public function __construct(

        #[MapOutputName('external_id')]
        public string $id,

        public string $name,

        public string $primaryFieldId,

        #[DataCollectionOf(AirtableFieldResourceResponseDto::class)]
        public Collection $fields,

//        #[DataCollectionOf(AirtableViewResourceResponseDto::class)]
//        public Collection $views,

    )
    {}

}
