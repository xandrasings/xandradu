<?php

namespace App\Jobs;

use App\Actions\HeartbeatAction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class HeartbeatJob implements ShouldQueue
{
    use Queueable;

    protected HeartbeatAction $heartbeatAction;

    public function __construct()
    {
        $this->heartbeatAction = app(HeartbeatAction::class);
    }

    public function handle(): void
    {
        $this->heartbeatAction->handle();
    }

}
