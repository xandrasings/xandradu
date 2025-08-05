<?php

namespace App\Modules\Core\Actions;

use DateTimeImmutable;
use Illuminate\Support\Facades\Log;

class HeartbeatAction
{
    public function handle(): void
    {
        $datetime = new DateTimeImmutable();

        $datetimeString =  $datetime->format('Y-m-d H:i:s');

        Log::notice("heartbeat! Alive at $datetimeString");
    }
}
