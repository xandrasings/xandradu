<?php

namespace App\Modules\Todoist\Actions;

use App\Models\TodoistColor;
use Illuminate\Support\Facades\Log;
use Throwable;

class TodoistColorInstantiateAction
{
    public function handle(string $code, string $name): ?TodoistColor
    {
        try {
            Log::notice("TodoistColorInstantiateAction creating TodoistColor with code $code and name $name.");
            return TodoistColor::create([
                'code' => $code,
                'name' => $name
            ]);
        } catch (Throwable $exception) {
            Log::warning("TodoistColorInstantiateAction failed with exception {$exception->getMessage()}.");
            return null;
        }
    }
}
