<?php

namespace App\Modules\Todoist\Actions;

use App\Models\TodoistProject;
use App\Models\TodoistUser;
use Illuminate\Support\Facades\Log;
use Throwable;

class TodoistProjectUserAssociateAction
{
    public function handle(TodoistProject $project, TodoistUser $user, ?string $parentProjectId = null, int $childOrder = 0): bool
    {
        try {
            // TODO alter this logic to only apply the intermediate table values if we know they're correct
            // TODO alter this logic to still update the intermediate table values even if the relationship is already in place
            if (!$user->projects->contains($project)) {
                Log::notice("TodoistProjectUserAssociateAction associating TodoistProject $project->id with TodoistUser $user->id.");
                $user->projects()->attach($project->id, ['parent_project_id' => $parentProjectId, 'rank' => $childOrder]);
            }
        } catch (Throwable $exception) {
            Log::warning("TodoistProjectUserAssociateAction failed with exception {$exception->getMessage()}");
            return false;
        }
        return true;
    }
}
