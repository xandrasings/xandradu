<?php

namespace App\Modules\Airtable\Dtos;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class AirtableRecordResourceResponseDto extends Data
{
    #[MapOutputName('external_id')]
    public string $id;
}
