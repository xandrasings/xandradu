<?php

namespace App\Modules\Airtable\Casters;

use App\Modules\Airtable\Dtos\AirtableUpdatedAtFieldOptionsFieldResourceResponseDto;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\DataProperty;

class AirtableUpdatedAtFieldOptionsFieldResourceCaster implements Cast
{
    public function cast(DataProperty $property, mixed $value, array $properties, $context): mixed
    {
        return collect($value)
            ->map(function ($item) {
                return AirtableUpdatedAtFieldOptionsFieldResourceResponseDto::from(['referencedFieldId' => $item]);
            });
    }
}
