<?php

namespace App\Modules\Todoist\Actions;

use App\Models\TodoistAccount;
use App\Models\TodoistProject;
use App\Utilities\ValidationUtility;
use Illuminate\Support\Facades\Log;

class TodoistProjectUpdateAction
{
    protected ValidationUtility $validationUtility;

    protected TodoistTaskLocationCreateAction $taskLocationCreateAction;

    protected TodoistProjectSelectAction $projectSelectAction;

    protected TodoistColorGetAction $colorGetAction;

    protected TodoistProjectUsersSyncAction $projectUsersSyncAction;

    public function __construct()
    {
        $this->validationUtility = new ValidationUtility();
        $this->taskLocationCreateAction = new TodoistTaskLocationCreateAction();
        $this->projectSelectAction = new TodoistProjectSelectAction();
        $this->colorGetAction = new TodoistColorGetAction();
        $this->projectUsersSyncAction = new TodoistProjectUsersSyncAction();
    }

    public function handle(TodoistAccount $account, TodoistProject $project, array $projectPayload): ?TodoistProject
    {
        $childOrder = data_get($projectPayload, 'child_order');
        $color = data_get($projectPayload, 'color');
        $isFavorite = data_get($projectPayload, 'is_favorite');
        $name = data_get($projectPayload, 'name');
        $id = data_get($projectPayload, 'v2_id');
        $parentId = data_get($projectPayload, 'v2_parent_id');

        if (!$this->validationUtility->containsNoNulls([$childOrder, $color, $isFavorite, $name, $id, $parentId])) {
            Log::warning("TodoistProjectUpdateAction couldn't proceed due to a missing non-nullable variable");
            return null;
        }

        $todoistColor = $this->colorGetAction->handle($color);

        if (is_null($todoistColor)) {
            Log::warning("TodoistProjectCreateAction couldn't proceed due to color not being successfully created.");
            return null;
        }

        $parentProjectId = $this->getParentProjectId($parentId);

        $project->update([
            'name' => $name,
            'parent_project_id' => $parentProjectId,
            'parent_project_rank' => $childOrder,
            'color_id' => $todoistColor->id,
            'is_favorite' => $isFavorite,
        ]);

        $result = $this->projectUsersSyncAction->handle($account, $project, $projectPayload);
        if (!$result) {
            Log::warning("TodoistProjectUpdateAction couldn't proceed due unsuccessful assignment of users to project.");
            return null;
        }

        return $project;
    }

    private function getParentProjectId(?string $parentId): ?int
    {
        if (is_null($parentId)) {
            return null;
        }

        $parentProject = $this->projectSelectAction->handle($parentId);

        if (is_null($parentProject)) {
            Log::warning("TodoistProjectCreateAction was not able to identify the parent project from its id $parentId.");
            return null;
        }

        return $parentProject->id;
    }
}
