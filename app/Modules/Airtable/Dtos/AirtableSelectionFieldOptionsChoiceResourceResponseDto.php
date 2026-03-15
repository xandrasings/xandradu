<?php

namespace App\Modules\Airtable\Dtos;

use App\Modules\Airtable\Enums\AirtableSelectionFieldOptionsChoiceResourceColorEnum;
use App\Transformers\LengthyStringTransformer;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Casts\EnumCast;

class AirtableSelectionFieldOptionsChoiceResourceResponseDto extends AirtableFieldResourceResponseDto
{
    #[MapOutputName('external_id')]
    public string $id;

    #[WithTransformer(LengthyStringTransformer::class, length: 64)]
    public string $name;

    #[WithCast(EnumCast::class, type: AirtableSelectionFieldOptionsChoiceResourceColorEnum::class)]
    public ?AirtableSelectionFieldOptionsChoiceResourceColorEnum $color;
}
