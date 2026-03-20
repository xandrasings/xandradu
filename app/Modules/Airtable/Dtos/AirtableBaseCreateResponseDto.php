<?php

namespace App\Modules\Airtable\Dtos;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class AirtableBaseCreateResponseDto extends Data
{
    public function __construct(

        #[MapOutputName('external_id')]
        public string $id,

        // TODO relate this to a table DTO
        public array $tables
    ) {}
}
