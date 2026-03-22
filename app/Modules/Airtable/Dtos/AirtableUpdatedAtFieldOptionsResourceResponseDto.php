<?php

namespace App\Modules\Airtable\Dtos;

use App\Modules\Airtable\Casters\AirtableReferencedFieldIdsResourceCaster;
use App\Transformers\AssertTrueBooleanTransformer;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class AirtableUpdatedAtFieldOptionsResourceResponseDto extends Data
{
    #[WithTransformer(AssertTrueBooleanTransformer::class)]
    public bool $isValid;

    #[WithCast(AirtableReferencedFieldIdsResourceCaster::class)]
    #[DataCollectionOf(AirtableReferencedFieldIdResourceResponseDto::class)]
    public Collection $referencedFieldIds;

    public ?AirtableUpdatedAtFieldOptionsResultResourceResponseDto $result;
}
