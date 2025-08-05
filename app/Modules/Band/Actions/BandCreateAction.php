<?php

namespace App\Modules\Band\Actions;

use App\Modules\Band\Models\Band;
use Illuminate\Support\Facades\Log;
use Throwable;

class BandCreateAction
{
    public function handle(string $name): ?Band
    {
        try {
            Log::notice("BandCreateAction creating Band with name $name.");
            return Band::create([
                'name' => $name,
            ]);
        } catch (Throwable $exception) {
            Log::warning("BandCreateAction failed with exception {$exception->getMessage()}.");
            return null;
        }
    }
}
