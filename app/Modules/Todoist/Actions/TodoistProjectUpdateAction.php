<?php

namespace App\Modules\Todoist\Actions;

use App\Modules\Todoist\Models\TodoistAccount;
use App\Modules\Todoist\Models\TodoistProject;
use App\Utilities\ValidationUtility;
use Illuminate\Support\Facades\Log;
use Throwable;

class TodoistProjectUpdateAction
{
    protected ValidationUtility $validationUtility;

    protected TodoistNodeInstantiateAction $nodeInstantiateAction;

    protected TodoistProjectSelectAction $projectSelectAction;

    protected TodoistColorGetAction $colorGetAction;

    protected TodoistProjectUserApplyAllAction $projectUserApplyAllAction;

    public function __construct()
    {
        $this->validationUtility = app(ValidationUtility::class);
        $this->nodeInstantiateAction = app(TodoistNodeInstantiateAction::class);
        $this->projectSelectAction = app(TodoistProjectSelectAction::class);
        $this->colorGetAction = app(TodoistColorGetAction::class);
        $this->projectUserApplyAllAction = app(TodoistProjectUserApplyAllAction::class);
    }

    public function handle(TodoistAccount $account, TodoistProject $project, array $payload): ?TodoistProject
    {
        $colorCode = data_get($payload, 'color');
        $isFavorite = data_get($payload, 'is_favorite');
        $name = data_get($payload, 'name');
        $id = data_get($payload, 'v2_id');
        $isArchived = data_get($payload, 'is_archived');
        $isDeleted = data_get($payload, 'is_deleted');
        // TODO deal with is_archived and is_deleted
        if (!$this->validationUtility->containsNoNulls([$colorCode, $isFavorite, $name, $id])) {
            Log::warning("TodoistProjectUpdateAction couldn't proceed due to a missing non-nullable variable.");
            return null;
        }

        $color = $this->colorGetAction->handle($colorCode);
        if (!$this->validationUtility->containsNoNulls([$colorCode])) {
            Log::warning("TodoistProjectUpdateAction couldn't proceed due to a missing non-nullable variable.");
            return null;
        }

        try {
            Log::notice("TodoistProjectUpdateAction updating TodoistProject $id");
            $project->update([
                'name' => $name,
                'color_id' => $color->id,
                'is_favorite' => $isFavorite,
            ]);
        } catch (Throwable $exception) {
            Log::warning("TodoistProjectUpdateAction failed with exception {$exception->getMessage()}.");
            return null;
        }

        $result = $this->projectUserApplyAllAction->handle($account, $project, $payload);
        if (!$result) {
            Log::warning("TodoistProjectUpdateAction couldn't proceed due unsuccessful assignment of users to project.");
            return null;
        }

        return $project;
    }
}
