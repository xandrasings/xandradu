<?php

namespace App\Modules\Todoist\Actions;

use App\Models\TodoistAccount;
use App\Models\TodoistProject;
use App\Utilities\ValidationUtility;
use Illuminate\Support\Facades\Log;
use Throwable;

class TodoistProjectCreateAction
{
    protected ValidationUtility $validationUtility;

    protected TodoistTaskLocationCreateAction $taskLocationCreateAction;

    protected TodoistProjectSelectAction $projectGetAction;

    protected TodoistColorGetAction $colorGetAction;

    protected TodoistProjectUsersSyncAction $projectUsersSyncAction;

    public function __construct()
    {
        $this->validationUtility = new ValidationUtility();
        $this->taskLocationCreateAction = new TodoistTaskLocationCreateAction();
        $this->projectGetAction = new TodoistProjectSelectAction();
        $this->colorGetAction = new TodoistColorGetAction();
        $this->projectUsersSyncAction = new TodoistProjectUsersSyncAction();
    }

    public function handle(TodoistAccount $account, array $projectPayload): ?TodoistProject
    {
        $childOrder = data_get($projectPayload, 'child_order');
        $color = data_get($projectPayload, 'color');
        $isArchived = data_get($projectPayload, 'is_archived');
        $isDeleted = data_get($projectPayload, 'is_deleted');
        $isFavorite = data_get($projectPayload, 'is_favorite');
        $name = data_get($projectPayload, 'name');
        $shared = data_get($projectPayload, 'shared');
        $id = data_get($projectPayload, 'v2_id');
        $parentId = data_get($projectPayload, 'v2_parent_id');

        if (! $this->validationUtility->containsNoNulls([$childOrder, $color, $isArchived, $isDeleted, $isFavorite, $name, $shared, $id])) {
            Log::error("TodoistProjectCreateAction couldn't proceed due to a missing non-nullable variable.");
            return null;
        }

        $todoistColor = $this->colorGetAction->handle($color);

        if (is_null($todoistColor)) {
            Log::error("TodoistProjectCreateAction couldn't proceed due to color not being successfully created.");
            return null;
        }

        $taskLocation = $this->taskLocationCreateAction->handle();

        if (is_null($taskLocation)) {
            Log::error("TodoistProjectCreateAction couldn't proceed due to task location not being successfully created.");
            return null;
        }

        $parentProjectId = $this->getParentProjectId($parentId);

        try {
            Log::notice("TodoistProjectCreateAction creating TodoistProject $name $id");
            $project = TodoistProject::create([
                'location_reference_id' => $taskLocation->id,
                'external_id' => $id,
                'name' => $name,
                'parent_project_id' => $parentProjectId,
                'parent_project_rank' => $childOrder,
                'color_id' => $todoistColor->id,
                'is_favorite' => $isFavorite,
            ]);
        } catch (Throwable $exception) {
            Log::warning("TodoistProjectCreateAction failed with exception {$exception->getMessage()}");
            return null;
        }

        if (!$this->projectUsersSyncAction->handle($account, $project, $projectPayload)) {
            Log::warning("TodoistProjectCreateAction couldn't proceed due unsuccessful assignment of users to project.");
            return null;
        }

        return $project;
    }

    private function getParentProjectId(mixed $parentId): ?int
    {
        if (is_null($parentId)) {
            return null;
        }

        $parentProject = $this->projectGetAction->handle($parentId);

        if (is_null($parentProject)) {
            Log::warning("TodoistProjectCreateAction was not able to identify the parent project from its id $parentId.");
            return null;
        }

        return $parentProject->id;

    }
}
