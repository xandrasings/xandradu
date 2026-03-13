<?php

namespace App\Modules\Airtable\Dtos;

use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;

class AirtableBaseResourceResponseDto extends Data
{
    #[MapOutputName('external_id')]
    public string $id;

    public string $name;
}
