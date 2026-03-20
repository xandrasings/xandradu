<?php

namespace App\Modules\Airtable\Dtos;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class AirtableLongTextFieldResourceResponseDto extends AirtableFieldResourceResponseDto {}
