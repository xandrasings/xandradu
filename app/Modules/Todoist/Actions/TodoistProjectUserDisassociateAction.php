<?php

namespace App\Modules\Todoist\Actions;

use App\Models\TodoistProject;
use App\Models\TodoistUser;
use Illuminate\Support\Facades\Log;
use Throwable;

class TodoistProjectUserDisassociateAction
{
    public function handle(TodoistProject $project, TodoistUser $user): bool
    {
        try {
            if ($user->projects->contains($project)) {
                $user->projects()->detach($project->id);
            }
        } catch (Throwable $exception) {
            Log::error("TodoistProjectUserDisassociateAction failed with exception {$exception->getMessage()}");
            return false;
        }
        return true;
    }
}
