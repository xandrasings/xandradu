<?php

namespace App\Modules\Todoist\Jobs;

use App\Modules\Todoist\Actions\TodoistAccountSyncAllAction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class TodoistAccountsSyncJob implements ShouldQueue
{
    use Queueable;

    protected TodoistAccountSyncAllAction $accountSyncAllAction;

    public function __construct()
    {
        $this->accountSyncAllAction = app(TodoistAccountSyncAllAction::class);
    }

    public function handle(): void
    {
        $this->accountSyncAllAction->handle();
    }

}
