<?php

namespace App\Modules\Todoist\Actions;

use App\Models\TodoistProject;
use Illuminate\Support\Facades\Log;

class TodoistProjectGetAction
{
    public function handle(string $externalId): ?TodoistProject
    {
        $projects = TodoistProject::where([
            'external_id' => $externalId
        ])->get();

        if ($projects->count() > 1) {
            Log::warning("TodoistProjectGetAction failed because multiple projects with external id $externalId exist.");
            return null;
        }

        if ($projects->isEmpty()) {
            Log::warning("TodoistProjectGetAction failed because no projects with external id $externalId exist.");
            return null;
        }

        return $projects->first();
    }
}
