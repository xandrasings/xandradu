<?php

namespace App\Modules\Airtable\Dtos;

use App\Transformers\ShortenLengthyStringTransformer;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class AirtableAiTextFieldOptionsTextPromptComponentResourceResponseDto extends AirtableAiTextFieldOptionsPromptComponentResourceResponseDto
{
    #[WithTransformer(ShortenLengthyStringTransformer::class, length: 2048)]
    public string $text;
}
