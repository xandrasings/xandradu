<?php

namespace App\Modules\Todoist\Actions;

use App\Modules\Todoist\Models\TodoistAccount;
use App\Modules\Todoist\Models\TodoistProject;
use Illuminate\Support\Facades\Log;

class TodoistProjectUserDisassociateAllAction
{
    protected TodoistProjectUserAssociateAction $projectUserAssociateAction;

    protected TodoistProjectUserDisassociateAction $projectUserDisassociateAction;

    public function __construct()
    {
        $this->projectUserAssociateAction = app(TodoistProjectUserAssociateAction::class);
        $this->projectUserDisassociateAction = app(TodoistProjectUserDisassociateAction::class);
    }

    public function handle(TodoistAccount $account, TodoistProject $project, ?TodoistProject $parentProject, int $childOrder): bool
    {
        $result = $this->projectUserAssociateAction->handle($project, $account->user, $parentProject, $childOrder);
        if (!$result) {
            Log::warning("TodoistProjectUserDisassociateAllAction failed due to failed call to TodoistProjectUserAssociateAction.");
            return false;
        }

        $result = $project->users->map(function ($user) use ($parentProject, $account, $project) {
            if ($user->id === $account->user->id) {
                return true;
            }

            return $this->projectUserDisassociateAction->handle($project, $account->user);
        })->reduce(function (bool $carry, bool $result) {
            return $carry && $result;
        }, true);

        if (!$result) {
            Log::warning("TodoistProjectUserDisassociateAllAction failed due to failed call to TodoistProjectUserDisassociateAction.");
            return false;
        }

        return true;
    }
}
