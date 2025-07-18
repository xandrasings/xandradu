<?php

namespace App\Actions;

use Illuminate\Support\Facades\Log;

class HeartbeatAction
{
    public function handle(): void
    {
        Log::notice("heartbeat!");
    }
}
