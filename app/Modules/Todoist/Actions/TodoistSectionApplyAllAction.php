<?php

namespace App\Modules\Todoist\Actions;

class TodoistSectionApplyAllAction
{

    protected TodoistSectionApplyAction $sectionApplyAction;

    public function __construct()
    {
        $this->sectionApplyAction = app(TodoistSectionApplyAction::class);
    }


    public function handle(array $payloads): bool
    {
        return collect($payloads)->map(function ($payload) {
            return ! is_null($this->sectionApplyAction->handle($payload));
        })->reduce(function (bool $carry, bool $result) {
            return $carry && $result;
        }, true);
    }
}
