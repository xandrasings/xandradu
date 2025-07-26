<?php

namespace App\Modules\Todoist\Actions;

use App\Models\TodoistAccount;

class TodoistSectionsSyncAction
{

    protected TodoistSectionSyncAction $sectionSyncAction;

    public function __construct()
    {
        $this->sectionSyncAction = new TodoistSectionSyncAction();
    }


    public function handle(array $sectionsPayload): void
    {
        collect($sectionsPayload)->each(function ($sectionPayload) {
            $this->sectionSyncAction->handle($sectionPayload);
        });
    }
}
