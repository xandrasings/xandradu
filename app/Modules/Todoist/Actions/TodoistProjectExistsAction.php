<?php

namespace App\Modules\Todoist\Actions;

use App\Models\TodoistProject;

class TodoistProjectExistsAction
{
    public function handle(string $id): bool
    {
        return TodoistProject::where([
            'external_id' => $id
        ])->withTrashed()->get()->count() > 0;
    }
}
