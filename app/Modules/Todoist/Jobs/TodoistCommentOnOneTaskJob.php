<?php

namespace App\Modules\Todoist\Jobs;

use App\Modules\Todoist\Actions\TodoistCommentOnOneTaskAction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class TodoistCommentOnOneTaskJob implements ShouldQueue
{
    use Queueable;

    protected TodoistCommentOnOneTaskAction $todoistCommentOnOneTaskAction;

    public function __construct()
    {
        $this->todoistCommentOnOneTaskAction = app(TodoistCommentOnOneTaskAction::class);
    }

    public function handle(): void
    {
        $this->todoistCommentOnOneTaskAction->handle();
    }

}
