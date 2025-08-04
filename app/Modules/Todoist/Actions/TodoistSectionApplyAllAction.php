<?php

namespace App\Modules\Todoist\Actions;

use Illuminate\Support\Facades\Log;

class TodoistSectionApplyAllAction
{

    protected TodoistSectionApplyAction $sectionApplyAction;

    public function __construct()
    {
        $this->sectionApplyAction = app(TodoistSectionApplyAction::class);
    }


    public function handle(array $payloads): bool
    {
        $result = collect($payloads)->map(function ($payload) {
            return ! is_null($this->sectionApplyAction->handle($payload));
        })->reduce(function (bool $carry, bool $result) {
            return $carry && $result;
        }, true);

        if (! $result) {
            Log::warning("TodoistSectionApplyAllAction failed.");
        }

        return $result;
    }
}
