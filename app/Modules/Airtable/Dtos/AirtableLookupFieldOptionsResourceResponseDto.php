<?php

namespace App\Modules\Airtable\Dtos;

use App\Transformers\AssertTrueBooleanTransformer;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class AirtableLookupFieldOptionsResourceResponseDto extends Data
{
    #[WithTransformer(AssertTrueBooleanTransformer::class)]
    public bool $isValid;

    #[MapOutputName('referenced_field_id')]
    public ?string $recordLinkFieldId;

    #[MapOutputName('targeted_field_id')]
    public ?string $fieldIdInLinkedTable;
}
