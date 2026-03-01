<?php

namespace App\Modules\Airtable\Dtos;

use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;

final class AirtableBaseResourceResponseDto extends Data
{
    public function __construct(

        #[MapOutputName('external_id')]
        public string $id,

        public string $name,
    )
    {}
}
