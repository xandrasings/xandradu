<?php

namespace App\Transformers;

use Illuminate\Support\Facades\Log;
use Spatie\LaravelData\Support\DataProperty;
use Spatie\LaravelData\Support\Transformation\TransformationContext;
use Spatie\LaravelData\Transformers\Transformer;

class LengthyStringTransformer implements Transformer
{
    protected string $length;

    public function __construct(
        int $length,
    ) {
        $this->length = $length;
    }

    public function transform(DataProperty $property, mixed $value, TransformationContext $context): string
    {

        if (strlen($value) > $this->length) {
            Log::warning('Encountered a length too long to persist.', ['value' => $value]);
            return substr($value, 0, $this->length);
        }

        return $value;
    }
}
