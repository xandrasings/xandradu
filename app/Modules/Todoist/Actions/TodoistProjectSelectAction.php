<?php

namespace App\Modules\Todoist\Actions;

use App\Modules\Todoist\Models\TodoistProject;
use Illuminate\Support\Facades\Log;

class TodoistProjectSelectAction
{
    public function handle(string $id): ?TodoistProject
    {
        $projects = TodoistProject::where([
            'external_id' => $id
        ])->get();

        if ($projects->count() > 1) {
            Log::warning("TodoistProjectSelectAction failed because multiple TodoistProjects with external id $id exist.");
            return null;
        }

        if ($projects->isEmpty()) {
            Log::warning("TodoistProjectSelectAction failed because no TodoistProjects with external id $id exist.");
            return null;
        }

        return $projects->first();
    }
}
