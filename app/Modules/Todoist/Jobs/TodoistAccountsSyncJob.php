<?php

namespace App\Modules\Todoist\Jobs;

use App\Modules\Todoist\Actions\TodoistAccountsSyncAction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class TodoistAccountsSyncJob implements ShouldQueue
{
    use Queueable;

    protected TodoistAccountsSyncAction $todoistAccountsSyncAction;

    public function __construct()
    {
        $this->todoistAccountsSyncAction = app(TodoistAccountsSyncAction::class);
    }

    public function handle(): void
    {
        $this->todoistAccountsSyncAction->handle();
    }

}
