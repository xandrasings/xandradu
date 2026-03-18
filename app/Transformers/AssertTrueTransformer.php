<?php

namespace App\Transformers;

use Illuminate\Support\Facades\Log;
use Spatie\LaravelData\Support\DataProperty;
use Spatie\LaravelData\Support\Transformation\TransformationContext;
use Spatie\LaravelData\Transformers\Transformer;

class AssertTrueTransformer implements Transformer
{
    public function transform(DataProperty $property, mixed $value, TransformationContext $context): string
    {

        if (! $value) {
            Log::warning('Encountered a falsy value.', ['value' => $value, 'property' => $property]);
        }

        return $value;
    }
}
