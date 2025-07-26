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

    protected TodoistColorGetAction $colorGetAction;

    protected TodoistProjectUsersSyncAction $projectUsersSyncAction;

    public function __construct()
    {
        $this->validationUtility = new ValidationUtility();
        $this->taskLocationCreateAction = new TodoistTaskLocationCreateAction();
        $this->colorGetAction = new TodoistColorGetAction();
        $this->projectUsersSyncAction = new TodoistProjectUsersSyncAction();
    }

    public function handle(TodoistAccount $account, array $projectPayload): ?TodoistProject
    {
        $color = data_get($projectPayload, 'color');
        $isFavorite = data_get($projectPayload, 'is_favorite');
        $name = data_get($projectPayload, 'name');
        $id = data_get($projectPayload, 'v2_id');

        if (! $this->validationUtility->containsNoNulls([$color, $isFavorite, $name, $id])) {
            Log::warning("TodoistProjectCreateAction couldn't proceed due to a missing non-nullable variable.");
            return null;
        }

        $todoistColor = $this->colorGetAction->handle($color);

        if (is_null($todoistColor)) {
            Log::warning("TodoistProjectCreateAction couldn't proceed due to color not being successfully created.");
            return null;
        }

        $taskLocation = $this->taskLocationCreateAction->handle();

        if (is_null($taskLocation)) {
            Log::warning("TodoistProjectCreateAction couldn't proceed due to task location not being successfully created.");
            return null;
        }

        try {
            Log::notice("TodoistProjectCreateAction creating TodoistProject $name $id");
            $project = TodoistProject::create([
                'location_reference_id' => $taskLocation->id,
                'external_id' => $id,
                'name' => $name,
                'color_id' => $todoistColor->id,
                'is_favorite' => $isFavorite,
            ]);
        } catch (Throwable $exception) {
            Log::warning("TodoistProjectCreateAction failed with exception {$exception->getMessage()}");
            return null;
        }

        $result = $this->projectUsersSyncAction->handle($account, $project, $projectPayload);
        if (!$result) {
            Log::warning("TodoistProjectCreateAction couldn't proceed due unsuccessful assignment of users to project.");
            return null;
        }

        return $project;
    }
}
