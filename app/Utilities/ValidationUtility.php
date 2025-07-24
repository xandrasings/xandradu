<?php

namespace App\Utilities;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class ValidationUtility
{
    public function containsNoNulls(array $variables): bool
    {
        foreach ($variables as $variable) {
            if (is_null($variable)) {
                Log::warning("encountered a null variable while validating no null variables.");
                return false;
            }
        }
        return true;
    }

    public function containsNoMoreThanOne(Collection $collection): bool
    {
        $count = $collection->count();
        if ($count > 1) {
            Log::warning("encountered a collection of size $count while validating count of no more than 1.");
            return false;
        }
        return true;
    }
}
