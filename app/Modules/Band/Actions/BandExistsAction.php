<?php

namespace App\Modules\Band\Actions;

use App\Modules\Band\Models\Band;

class BandExistsAction
{
    public function handle(string $name): bool
    {
        $bands = Band::where([
            'name' => $name,
        ])->get();

        return $bands->count() > 0;
    }
}
