<?php

namespace App\Modules\Todoist\Actions;

use App\Models\TodoistAccount;
use App\Models\TodoistProject;
use App\Utilities\ValidationUtility;
use Illuminate\Support\Facades\Log;

class TodoistProjectSyncAction
{
    protected ValidationUtility $validationUtility;

    protected TodoistProjectDeleteAction $projectDeleteAction;

    protected TodoistProjectCreateAction $projectCreateAction;

    protected TodoistProjectUpdateAction $projectUpdateAction;

    public function __construct()
    {
        $this->validationUtility = app(ValidationUtility::class);
        $this->projectDeleteAction = app(TodoistProjectDeleteAction::class);
        $this->projectCreateAction = app(TodoistProjectCreateAction::class);
        $this->projectUpdateAction = app(TodoistProjectUpdateAction::class);
    }

    public function handle(TodoistAccount $account, array $projectPayload): ?TodoistProject
    {
        $id = data_get($projectPayload, 'v2_id');
        $isArchived = data_get($projectPayload, 'is_archived');
        $isDeleted = data_get($projectPayload, 'is_deleted');

        if (! $this->validationUtility->containsNoNulls([$id, $isArchived, $isDeleted])) {
            Log::warning("TodoistProjectSyncAction couldn't proceed due to a missing non-nullable variable");
            return null;
        }

        $projects = TodoistProject::where(['external_id' => $id])->get();

        if (! $this->validationUtility->containsNoMoreThanOne($projects)) {
            Log::warning("TodoistProjectSyncAction couldn't proceed due to multiple Todoist projects matching this id.");
            return null;
        }

        if ($isArchived || $isDeleted) {
            if ($projects->isEmpty()) {
                return null;
            }

            return $this->projectDeleteAction->handle($projects->first());
        }

        if ($projects->isEmpty()) {
            return $this->projectCreateAction->handle($account, $projectPayload);
        }

        return $this->projectUpdateAction->handle($account, $projects->first(), $projectPayload);
    }
}
