<?php

namespace App\Modules\Band\Actions;

use App\Modules\Band\Models\Band;
use Exception;
use Illuminate\Support\Facades\Log;

class BandCreateAction
{
    /**
     * @throws Exception
     */
    public function handle(string $name): Band
    {
        Log::notice("BandCreateAction creating Band with name $name.");
        return Band::create([
            'name' => $name,
        ]);
    }
}
