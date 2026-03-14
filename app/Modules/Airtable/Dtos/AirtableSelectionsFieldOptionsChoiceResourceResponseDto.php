<?php

namespace App\Modules\Airtable\Dtos;

use App\Modules\Airtable\Enums\AirtableSelectionsFieldOptionsChoiceResourceColorEnum;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;

class AirtableSelectionsFieldOptionsChoiceResourceResponseDto extends AirtableFieldResourceResponseDto
{
    #[MapOutputName('external_id')]
    public string $id;

    public string $name;

    #[WithCast(EnumCast::class, type: AirtableSelectionsFieldOptionsChoiceResourceColorEnum::class)]
    public ?AirtableSelectionsFieldOptionsChoiceResourceColorEnum $color;
}
