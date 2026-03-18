<?php

namespace App\Modules\Airtable\Dtos;

use App\Modules\Airtable\Casters\AirtableAiTextFieldOptionsPromptComponentResourceCaster;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class AirtableAiTextFieldOptionsResourceResponseDto extends Data
{
    #[WithCast(AirtableAiTextFieldOptionsPromptComponentResourceCaster::class)]
    #[DataCollectionOf(AirtableAiTextFieldOptionsPromptComponentResourceResponseDto::class)]
    public Collection $prompt;
}
