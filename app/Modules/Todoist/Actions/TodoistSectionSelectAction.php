<?php

namespace App\Modules\Todoist\Actions;

use App\Models\TodoistSection;
use Illuminate\Support\Facades\Log;

class TodoistSectionSelectAction
{
    public function handle(string $id): ?TodoistSection
    {
        $sections = TodoistSection::where([
            'external_id' => $id
        ])->get();

        if (count($sections) > 1) {
            Log::warning("TodoistSectionSelectAction failed because too many TodoistSections with external id $id exist.");
            return null;
        }

        if ($sections->isEmpty()) {
            Log::warning("TodoistSectionSelectAction failed because no TodoistSections with external id $id exist.");
            return null;
        }

        return $sections->first();
    }
}
