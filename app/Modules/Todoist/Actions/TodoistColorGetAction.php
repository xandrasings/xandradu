<?php

namespace App\Modules\Todoist\Actions;

use App\Modules\Todoist\Models\TodoistColor;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class TodoistColorGetAction
{
    protected TodoistColorInstantiateAction $colorInstantiateAction;

    public function __construct()
    {
        $this->colorInstantiateAction = app(TodoistColorInstantiateAction::class);
    }

    public function handle(string $code): ?TodoistColor
    {
        $name = Str::apa(str_replace('_', ' ', $code));

        $colors = TodoistColor::where([
            'code' => $code
        ])->get();

        if (count($colors) > 1) {
            Log::warning("TodoistColorGetAction failed, found too many TodoistColor records matching code $code.");
            return null;
        }

        if ($colors->isEmpty()) {
            return $this->colorInstantiateAction->handle($code, $name);
        }

        return $colors->first();
    }
}
