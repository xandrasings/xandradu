<?php

namespace App\Modules\Todoist\Actions;

use App\Modules\Todoist\Models\TodoistAccount;
use App\Modules\Todoist\Models\TodoistProject;
use App\Utilities\ValidationUtility;
use Illuminate\Support\Facades\Log;

class TodoistProjectUserApplyAllAction
{
    protected ValidationUtility $validationUtility;

    protected TodoistProjectSelectAction $projectSelectAction;

    protected TodoistProjectUserAssociateAllAction $projectUserAssociateAllAction;

    protected TodoistProjectUserDisassociateAllAction $projectUserDisassociateAllAction;

    public function __construct()
    {
        $this->validationUtility = app(ValidationUtility::class);
        $this->projectSelectAction = app(TodoistProjectSelectAction::class);
        $this->projectUserAssociateAllAction = app(TodoistProjectUserAssociateAllAction::class);
        $this->projectUserDisassociateAllAction = app(TodoistProjectUserDisassociateAllAction::class);
    }

    public function handle(TodoistAccount $account, TodoistProject $project, array $payload): bool
    {
        $childOrder = data_get($payload, 'child_order');
        $parentId = data_get($payload, 'v2_parent_id');
        $shared = data_get($payload, 'shared');
        if (!$this->validationUtility->containsNoNulls([$childOrder, $shared])) {
            Log::warning("TodoistProjectUsersSyncAction couldn't proceed due to a missing non-nullable variable.");
            return false;
        }

        if (is_null($parentId)) {
            $parentProject = null;
        } else {
            $parentProject = $this->projectSelectAction->handle($parentId);
            if (!$this->validationUtility->containsNoNulls([$parentProject])) {
                Log::warning("TodoistProjectUsersSyncAction couldn't proceed due to a missing non-nullable variable.");
                return false;
            }
        }

        if ($shared) {
            $result = $this->projectUserAssociateAllAction->handle($account, $project, $parentProject, $childOrder);
            if (!$result) {
                Log::warning("TodoistProjectUsersSyncAction failed due to failed call to TodoistProjectUserAssociateAllAction.");
                return false;
            }
        }

        $result = $this->projectUserDisassociateAllAction->handle($account, $project, $parentProject, $childOrder);
        if (!$result) {
            Log::warning("TodoistProjectUsersSyncAction failed due to failed call to TodoistProjectUserAssociateAllAction.");
            return false;
        }

        return true;
    }
}
