<?php

namespace App\Modules\Todoist\Actions;

use App\Models\TodoistColor;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

class TodoistColorGetAction
{
    public function handle(string $colorCode): ?TodoistColor
    {
        $name = Str::apa(str_replace('_', ' ', $colorCode));

        $colors = TodoistColor::where(['code' => $colorCode])->get();

        if (count($colors) > 1) {
            Log::warning("TodoistColorGetAction failed, found too many TodoistColor records matching code $colorCode.");
            return null;
        }

        if ($colors->isEmpty()) {
            try {
                Log::notice("TodoistColorGetAction creating TodoistColor $colorCode $name");
                return TodoistColor::create([
                    'code' => $colorCode,
                    'name' => $name
                ]);
            } catch (Throwable $exception) {
                Log::warning("TodoistColorGetAction failed with exception {$exception->getMessage()}");
                return null;
            }
        }

        $color = $colors->first();

        if ($color->name !== $name) {
            Log::warning("TodoistColorGetAction found TodoistColor name $color->name does not match value $name");
        }

        return $color;
    }
}
