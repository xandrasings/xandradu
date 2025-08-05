<?php

namespace App\Modules\Todoist\Actions;

use App\Models\TodoistAccount;

class TodoistAccountSyncAllAction
{
    protected TodoistAccountSyncAction $accountSyncAction;

    public function __construct()
    {
        $this->accountSyncAction = app(TodoistAccountSyncAction::class);
    }


    public function handle(): void
    {
        $accounts = TodoistAccount::get();

        $accounts->each(function ($account) {
            $this->accountSyncAction->handle($account);
        });
    }
}
