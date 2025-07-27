<?php

namespace App\Modules\Todoist\Actions;

use App\Models\TodoistAccount;

class TodoistAccountsSyncAction
{
    protected TodoistAccountSyncAction $accountSyncAction;

    public function __construct()
    {
        $this->accountSyncAction = app(TodoistAccountSyncAction::class);
    }


    public function handle(): void
    {
        $todoistAccounts = TodoistAccount::get();

        $todoistAccounts->each(function ($todoistAccount) {
            $this->accountSyncAction->handle($todoistAccount);
        });
    }
}
