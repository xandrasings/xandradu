<?php

namespace App\Modules\Airtable\Dtos;
use Spatie\LaravelData\Data;

class AirtableBaseCreateResponseDto extends Data
{
    public function __construct(
        public string $id,

        // TODO relate this to a table DTO
        public array $tables
    ) {}
}
