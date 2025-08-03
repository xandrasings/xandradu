<?php

namespace App\Modules\Band\Actions;

use App\Models\Band;
use Illuminate\Support\Facades\Log;

class BandSelectAction
{
    public function handle(string $name): ?Band
    {
        $band = Band::where([
            'name' => $name,
        ])->get();

        if ($band->count() > 1) {
            Log::warning("BandSelectAction failed because multiple Band records exist with name $name.");
            return null;
        }

        if($band->isEmpty()) {
            Log::warning("BandSelectAction failed because no Band records exist with name $name.");
            return null;
        }

        return $band->first();
    }
}
