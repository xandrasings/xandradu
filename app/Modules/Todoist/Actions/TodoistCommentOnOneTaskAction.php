<?php

namespace App\Modules\Todoist\Actions;

use App\Modules\Todoist\Clients\TodoistClient;

class TodoistCommentOnOneTaskAction {

    protected TodoistClient $todoistClient;

    public function __construct() {
        $this->todoistClient = app(TodoistClient::class);
    }


    public function handle(): void
    {
        $this->todoistClient->addCommentToTask();
    }
}
