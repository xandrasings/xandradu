<?php

namespace App\Actions;

use App\Models\Band;
use Illuminate\Support\Facades\Log;
use Throwable;

class BandRegisterAction
{
    public function handle(string $name): ?Band
    {
        $bands = Band::where([
            'name' => $name,
        ])->get();

        if ($bands->count() > 1) {
            Log::warning("Multiple bands named $name exist.");
            return null;
        }

        if(! $bands->isEmpty()) {
            Log::warning("Band $name already exists.");
            return $bands->first();
        }

        try {
            Log::notice("Creating new band $name.");
            return Band::create([
                'name' => $name,
            ]);
        } catch (Throwable $exception) {
            Log::warning("Failed to create band $name {$exception->getMessage()}");
            return null;
        }
    }
}
