<?php

namespace App\Modules\Todoist\Actions;

use App\Models\TodoistTaskLocation;
use Illuminate\Support\Facades\Log;
use Throwable;

class TodoistNodeInstantiateAction
{
    public function handle(): ?TodoistTaskLocation
    {
        try {
            Log::notice("TodoistNodeInstantiateAction creating TodoistNode");
            return TodoistTaskLocation::create([]);
        } catch (Throwable $exception) {
            Log::warning("TodoistNodeInstantiateAction failed with exception {$exception->getMessage()}.");
            return null;
        }
    }
}
