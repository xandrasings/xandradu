<?php

namespace App\Modules\Airtable\Dtos;

use App\Modules\Airtable\Enums\AirtableAiTextFieldOptionsPromptComponentTypeEnum;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
abstract class AirtableAiTextFieldOptionsPromptComponentResourceResponseDto extends Data
{
    public AirtableAiTextFieldOptionsPromptComponentTypeEnum $type;
}
