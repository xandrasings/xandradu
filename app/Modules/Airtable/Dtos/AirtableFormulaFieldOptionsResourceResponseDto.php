<?php

namespace App\Modules\Airtable\Dtos;

use App\Modules\Airtable\Casters\AirtableReferencedFieldIdsResourceCaster;
use App\Transformers\AssertTrueTransformer;
use App\Transformers\LengthyStringTransformer;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class AirtableFormulaFieldOptionsResourceResponseDto extends Data
{
    #[WithTransformer(AssertTrueTransformer::class)]
    public bool $isValid;

    #[WithTransformer(LengthyStringTransformer::class, length: 2048)]
    public string $formula;

    #[WithCast(AirtableReferencedFieldIdsResourceCaster::class)]
    #[DataCollectionOf(AirtableReferencedFieldIdResourceResponseDto::class)]
    public Collection $referencedFieldIds;
}
