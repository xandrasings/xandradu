<?php

namespace App\Modules\Todoist\Actions;

use App\Models\TodoistColor;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

class TodoistColorGetAction
{
    public function handle(string $color): ?TodoistColor
    {
        $name = Str::apa(str_replace('_', ' ', $color));

        $todoistColors = TodoistColor::where(['code' => $color])->get();

        if (count($todoistColors) > 1) {
            Log::warning("TodoistColorGetAction failed, found too many TodoistColor records matching code $color.");
            return null;
        }

        if ($todoistColors->isEmpty()) {
            Log::notice("TodoistColorGetAction creating TodoistColor $color $name");
            try {
                return TodoistColor::create([
                    'code' => $color,
                    'name' => $name
                ]);
            } catch (Throwable $exception) {
                Log::warning("TodoistColorGetAction failed with exception {$exception->getMessage()}");
                return null;
            }
        } else {
            $todoistColor = $todoistColors->first();

            if ($todoistColor->name === $name) {
                Log::warning("TodoistColorGetAction found TodoistColor name $todoistColor->name does not match value $name");
            }

            return $todoistColor;
        }
    }
}
