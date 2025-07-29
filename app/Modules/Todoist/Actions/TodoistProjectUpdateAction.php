<?php

namespace App\Modules\Todoist\Actions;

use App\Models\TodoistAccount;
use App\Models\TodoistProject;
use App\Utilities\ValidationUtility;
use Illuminate\Support\Facades\Log;
use Throwable;

class TodoistProjectUpdateAction
{
    protected ValidationUtility $validationUtility;

    protected TodoistTaskLocationCreateAction $taskLocationCreateAction;

    protected TodoistProjectSelectAction $projectSelectAction;

    protected TodoistColorGetAction $colorGetAction;

    protected TodoistProjectUsersSyncAction $projectUsersSyncAction;

    public function __construct()
    {
        $this->validationUtility = app(ValidationUtility::class);
        $this->taskLocationCreateAction = app(TodoistTaskLocationCreateAction::class);
        $this->projectSelectAction = app(TodoistProjectSelectAction::class);
        $this->colorGetAction = app(TodoistColorGetAction::class);
        $this->projectUsersSyncAction = app(TodoistProjectUsersSyncAction::class);
    }

    public function handle(TodoistAccount $account, TodoistProject $project, array $projectPayload): ?TodoistProject
    {
        $color = data_get($projectPayload, 'color');
        $isFavorite = data_get($projectPayload, 'is_favorite');
        $name = data_get($projectPayload, 'name');
        $id = data_get($projectPayload, 'v2_id');

        if (!$this->validationUtility->containsNoNulls([$color, $isFavorite, $name, $id])) {
            Log::warning("TodoistProjectUpdateAction couldn't proceed due to a missing non-nullable variable");
            return null;
        }

        $todoistColor = $this->colorGetAction->handle($color);

        if (is_null($todoistColor)) {
            Log::warning("TodoistProjectUpdateAction couldn't proceed due to color not being successfully created.");
            return null;
        }

        try {
            Log::notice("TodoistProjectUpdateAction updating TodoistProject $id");
            $project->update([
                'name' => $name,
                'color_id' => $todoistColor->id,
                'is_favorite' => $isFavorite,
            ]);
        } catch (Throwable $exception) {
            Log::warning("TodoistProjectUpdateAction failed with exception {$exception->getMessage()}");
            return null;
        }

        $result = $this->projectUsersSyncAction->handle($account, $project, $projectPayload);
        if (!$result) {
            Log::warning("TodoistProjectUpdateAction couldn't proceed due unsuccessful assignment of users to project.");
            return null;
        }

        return $project;
    }
}
