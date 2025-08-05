<?php

namespace App\Modules\Todoist\Actions;

use App\Modules\Todoist\Models\TodoistAccount;
use App\Modules\Todoist\Models\TodoistProject;
use App\Utilities\ValidationUtility;
use Illuminate\Support\Facades\Log;

class TodoistProjectApplyAction
{
    protected ValidationUtility $validationUtility;

    protected TodoistProjectExistsAction $projectExistsAction;

    protected TodoistProjectSelectAction $projectSelectAction;

    protected TodoistProjectInstantiateAction $projectInstantiateAction;

    protected TodoistProjectUpdateAction $projectUpdateAction;

    public function __construct()
    {
        $this->validationUtility = app(ValidationUtility::class);
        $this->projectExistsAction = app(TodoistProjectExistsAction::class);
        $this->projectSelectAction = app(TodoistProjectSelectAction::class);
        $this->projectInstantiateAction = app(TodoistProjectInstantiateAction::class);
        $this->projectUpdateAction = app(TodoistProjectUpdateAction::class);
    }

    public function handle(TodoistAccount $account, array $payload): ?TodoistProject
    {
        $id = data_get($payload, 'v2_id');
        if (!$this->validationUtility->containsNoNulls([$id])) {
            Log::warning("TodoistProjectApplyAction couldn't proceed due to a missing non-nullable variable.");
            return null;
        }

        if ($this->projectExistsAction->handle($id)) {
            $project = $this->projectSelectAction->handle($id);
            if (!$this->validationUtility->containsNoNulls([$project])) {
                Log::warning("TodoistProjectApplyAction couldn't proceed due to a missing non-nullable variable.");
                return null;
            }

            return $this->projectUpdateAction->handle($account, $project, $payload);
        }

        return $this->projectInstantiateAction->handle($account, $payload);
    }
}
