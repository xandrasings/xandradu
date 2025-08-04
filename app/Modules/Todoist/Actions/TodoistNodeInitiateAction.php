<?php

namespace App\Modules\Todoist\Actions;

use App\Models\TodoistTaskLocation;
use Illuminate\Support\Facades\Log;
use Throwable;

class TodoistNodeInitiateAction
{
    public function handle(): ?TodoistTaskLocation
    {
        try {
            Log::notice("TodoistNodeInitiateAction creating TodoistNode");
            return TodoistTaskLocation::create([]);
        } catch (Throwable $exception) {
            Log::warning("TodoistNodeInitiateAction failed with exception {$exception->getMessage()}.");
            return null;
        }
    }
}
