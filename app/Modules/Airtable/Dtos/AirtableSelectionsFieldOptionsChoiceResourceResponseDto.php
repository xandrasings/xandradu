<?php

namespace App\Modules\Airtable\Dtos;

use App\Modules\Airtable\Enums\AirtableSelectionsFieldOptionsChoiceResourceColorEnum;
use App\Transformers\LengthyStringTransformer;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class AirtableSelectionsFieldOptionsChoiceResourceResponseDto extends AirtableFieldResourceResponseDto
{
    #[MapOutputName('external_id')]
    public string $id;

    #[WithTransformer(LengthyStringTransformer::class, length: 64)]
    public string $name;

    #[WithCast(EnumCast::class, type: AirtableSelectionsFieldOptionsChoiceResourceColorEnum::class)]
    public ?AirtableSelectionsFieldOptionsChoiceResourceColorEnum $color;
}
