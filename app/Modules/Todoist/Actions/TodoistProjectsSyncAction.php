<?php

namespace App\Modules\Todoist\Actions;

use App\Models\TodoistAccount;

class TodoistProjectsSyncAction
{

    protected TodoistProjectSyncAction $projectSyncAction;

    public function __construct()
    {
        $this->projectSyncAction = app(TodoistProjectSyncAction::class);
    }


    public function handle(TodoistAccount $account, array $projectsPayload): void
    {
        collect($projectsPayload)->each(function ($projectPayload) use ($account) {
            $this->projectSyncAction->handle($account, $projectPayload);
        });
    }
}
