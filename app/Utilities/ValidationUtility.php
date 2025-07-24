<?php

namespace App\Utilities;

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
}
