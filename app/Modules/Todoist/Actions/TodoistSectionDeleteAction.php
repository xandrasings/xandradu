<?php

namespace App\Modules\Todoist\Actions;

use App\Models\TodoistSection;
use Illuminate\Support\Facades\Log;
use Throwable;

class TodoistSectionDeleteAction
{

    public function handle(TodoistSection $section): ?TodoistSection
    {
        try {
            Log::notice("TodoistSectionDeleteAction deleting TodoistSection $section->id");
            $section->delete();
        } catch (Throwable $exception) {
            Log::warning("TodoistSectionDeleteAction failed with exception {$exception->getMessage()}");
            return null;
        }
        return $section;
    }
}
