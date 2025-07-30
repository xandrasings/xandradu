<?php

namespace App\Modules\Todoist\Actions;

class TodoistSectionsSyncAction
{

    protected TodoistSectionSyncAction $sectionSyncAction;

    public function __construct()
    {
        $this->sectionSyncAction = app(TodoistSectionSyncAction::class);
    }


    public function handle(array $sectionsPayload): void
    {
        collect($sectionsPayload)->each(function ($sectionPayload) {
            $this->sectionSyncAction->handle($sectionPayload);
        });
    }
}
