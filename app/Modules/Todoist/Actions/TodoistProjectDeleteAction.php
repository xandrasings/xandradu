<?php

namespace App\Modules\Todoist\Actions;

use App\Modules\Todoist\Models\TodoistProject;
use Illuminate\Support\Facades\Log;
use Throwable;

class TodoistProjectDeleteAction
{

    public function handle(TodoistProject $project): ?TodoistProject
    {
        try {
            Log::notice("TodoistProjectDeleteAction deleting TodoistProject $project->id");
            $project->delete();
        } catch (Throwable $exception) {
            Log::warning("TodoistProjectDeleteAction failed with exception {$exception->getMessage()}.");
            return null;
        }
        return $project;
    }
}
