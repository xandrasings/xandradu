<?php

namespace App\Modules\Airtable\Dtos;

use App\Transformers\LengthyStringTransformer;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Data;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class AirtableTableResourceResponseDto extends Data
{
    public int $rank = 0;

    #[MapOutputName('external_id')]
    public string $id;

    #[WithTransformer(LengthyStringTransformer::class, length: 32)]
    public string $name;

    public string $primaryFieldId; // TODO

    #[DataCollectionOf(AirtableFieldResourceResponseDto::class)]
    public Collection $fields;

//        #[DataCollectionOf(AirtableViewResourceResponseDto::class)] TODO
//        public Collection $views,

}
