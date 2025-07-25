<?php

namespace App\Modules\Todoist\Actions;

use App\Models\TodoistProject;
use App\Models\TodoistUser;
use Illuminate\Support\Facades\Log;
use Throwable;

class TodoistProjectUserAssociateAction
{
    public function handle(TodoistProject $project, TodoistUser $user): bool
    {
        try {
            if (!$user->projects->contains($project)) {
                Log::notice("TodoistProjectUserAssociateAction associating TodoistProject $project->id with TodoistUser $user->id.");
                $user->projects()->attach($project->id);
            }
        } catch (Throwable $exception) {
            Log::warning("TodoistProjectUserAssociateAction failed with exception {$exception->getMessage()}");
            return false;
        }
        return true;
    }
}
