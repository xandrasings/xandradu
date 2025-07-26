<?php

namespace App\Modules\Todoist\Actions;

use App\Models\TodoistAccount;

class TodoistAccountsSyncAction
{
    protected TodoistAccountSyncAction $todoistAccountSyncAction;

    public function __construct()
    {
        $this->todoistAccountSyncAction = app(TodoistAccountSyncAction::class);
    }


    public function handle(): void
    {
        $todoistAccounts = TodoistAccount::get();

        $todoistAccounts->each(function ($todoistAccount) {
            $this->todoistAccountSyncAction->handle($todoistAccount);
        });
    }
}
