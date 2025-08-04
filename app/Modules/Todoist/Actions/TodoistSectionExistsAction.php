<?php

namespace App\Modules\Todoist\Actions;

use App\Models\TodoistSection;

class TodoistSectionExistsAction
{
    public function handle(string $id): bool
    {
        return TodoistSection::where([
            'external_id' => $id
        ])->get()->count() > 0;
    }
}
