<?php

namespace App\Modules\Airtable\Dtos;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;
use Illuminate\Support\Collection;

class AirtableTableResourceResponseDto extends Data
{
    #[MapOutputName('external_id')]
    public string $id;

    public string $name;

    public string $primaryFieldId;

    #[DataCollectionOf(AirtableFieldResourceResponseDto::class)]
    public Collection $fields;

//        #[DataCollectionOf(AirtableViewResourceResponseDto::class)]
//        public Collection $views,

}
