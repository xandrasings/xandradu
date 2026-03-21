<?php

namespace App\Modules\Airtable\Casters;

use App\Modules\Airtable\Dtos\AirtableReferencedFieldIdResourceResponseDto;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Support\DataProperty;

class AirtableReferencedFieldIdsResourceCaster implements Cast
{
    public function cast(DataProperty $property, mixed $value, array $properties, $context): mixed
    {
        return collect($value)
            ->map(function ($item) {
                return AirtableReferencedFieldIdResourceResponseDto::from(['referencedFieldId' => $item]);
            });
    }
}
