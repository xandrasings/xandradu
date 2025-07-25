<?php

namespace App\Modules\Todoist\Actions;

use App\Models\TodoistTaskLocation;
use Illuminate\Support\Facades\Log;
use Throwable;

class TodoistTaskLocationCreateAction
{
    public function handle(): ?TodoistTaskLocation
    {
        try {
            Log::notice("TodoistTaskLocationCreateAction creating TodoistTaskLocation");
            return TodoistTaskLocation::create([]);
        } catch (Throwable $exception) {
            Log::warning("TodoistTaskLocationCreateAction failed with exception {$exception->getMessage()}");
            return null;
        }
    }
}
