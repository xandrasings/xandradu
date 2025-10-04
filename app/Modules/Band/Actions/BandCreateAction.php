<?php

namespace App\Modules\Band\Actions;

use App\Modules\Band\Models\Band;
use Exception;
use Illuminate\Support\Facades\Log;
use Throwable;

class BandCreateAction
{
    /**
     * @throws Exception
     */
    public function handle(string $name): Band
    {
        try {
            Log::notice("BandCreateAction creating Band with name $name.");
            return Band::create([
                'name' => $name,
            ]);
        } catch (Throwable $exception) {
            Log::warning("BandCreateAction failed with exception {$exception->getMessage()}.");
            throw new Exception("Unable to create Band.");
        }
    }
}
