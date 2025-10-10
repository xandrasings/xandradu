<?php

namespace App\Utilities;

use Exception;
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

    /**
     * @throws Exception
     */
    public function isNotNull($variable): void
    {
        if (is_null($variable)) {
            throw new Exception("encountered a null variable while validating no null variable.");
        }
    }

    /**
     * @throws Exception
     */
    public function areNotNull(Collection $variables): void
    {
        $variables->each(function ($variable) {
            $this->isNotNull($variable);
        });
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
