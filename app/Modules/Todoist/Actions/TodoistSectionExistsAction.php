<?php

namespace App\Modules\Todoist\Actions;

use App\Modules\Todoist\Models\TodoistSection;

class TodoistSectionExistsAction
{
    public function handle(string $id): bool
    {
        return TodoistSection::where([
            'external_id' => $id
        ])->withTrashed()->get()->count() > 0;
    }
}
