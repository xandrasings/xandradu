<?php

namespace App\Modules\Todoist\Actions;

use App\Models\TodoistAccount;
use App\Models\TodoistProject;
use App\Modules\Todoist\Clients\TodoistClient;
use App\Utilities\ValidationUtility;
use Illuminate\Support\Facades\Log;

class TodoistProjectUsersSyncAction
{
    protected ValidationUtility $validationUtility;

    protected TodoistProjectSelectAction $projectSelectAction;

    protected TodoistClient $client;

    protected TodoistProjectUserAssociateAction $projectUserAssociateAction;

    protected TodoistUserGetAction $userGetAction;

    protected TodoistProjectUserDisassociateAction $projectUserDisassociateAction;

    public function __construct()
    {
        $this->validationUtility = app(ValidationUtility::class);
        $this->projectSelectAction = app(TodoistProjectSelectAction::class);
        $this->client = app(TodoistClient::class);
        $this->projectUserAssociateAction = app(TodoistProjectUserAssociateAction::class);
        $this->userGetAction = app(TodoistUserGetAction::class);
        $this->projectUserDisassociateAction = app(TodoistProjectUserDisassociateAction::class);
    }

    public function handle(TodoistAccount $account, TodoistProject $project, array $projectPayload): bool
    {
        $childOrder = data_get($projectPayload, 'child_order');
        $parentId = data_get($projectPayload, 'v2_parent_id');
        $shared = data_get($projectPayload, 'shared');

        if (! $this->validationUtility->containsNoNulls([$childOrder, $shared])) {
            Log::warning("TodoistProjectUsersSyncAction couldn't proceed due to a missing non-nullable variable.");
            return false;
        }

        $parentProjectId = $this->getParentProjectId($parentId);

        $result = $this->projectUserAssociateAction->handle($project, $account->user, $parentProjectId, $childOrder);
        if (!$result) {
            Log::warning("TodoistProjectUsersSyncAction failed due to failed call to TodoistProjectUserAssociateAction.");
            return false;
        }

        return $shared ? $this->handleShared($account, $project) : $this->handleUnshared($account, $project);
    }

    private function getParentProjectId(?string $parentId): ?int
    {
        if (is_null($parentId)) {
            return null;
        }

        $parentProject = $this->projectSelectAction->handle($parentId);

        if (is_null($parentProject)) {
            Log::warning("TodoistProjectCreateAction was not able to identify the parent project from its id $parentId.");
            return null;
        }

        return $parentProject->id;
    }

    private function handleShared(TodoistAccount $account, TodoistProject $project): bool
    {
        $projectUsersPayload = $this->client->getProjectUsers($project, $account);
        if (is_null($projectUsersPayload)) {
            Log::warning("TodoistProjectUsersSyncAction failed due to failed call to TodoistClient.");
            return false;
        }

        $result = $project->users->map(function ($user) use ($projectUsersPayload, $project) {
            if ($projectUsersPayload->map(function ($projectUserPayload) use ($project) {
                return data_get($projectUserPayload, 'id');
            })->contains($user->external_id)) {
                return true;
            }

            $result = $this->projectUserDisassociateAction->handle($project, $user);
            if (!$result) {
                Log::warning("TodoistProjectUsersSyncAction failed due to failed call to TodoistProjectUserDisassociateAction.");
                return false;
            }

            return true;
        })->reduce(function (bool $carry, bool $result) {
            return $carry && $result;
        }, true);

        if (!$result) {
            return false;
        }

        $result = $projectUsersPayload->map(function ($projectUserPayload) use ($account, $project) {
            $id = data_get($projectUserPayload, 'id');
            $emailAddress = data_get($projectUserPayload, 'email');
            $name = data_get($projectUserPayload, 'name');

            if (! $this->validationUtility->containsNoNulls([$id, $emailAddress, $name])) {
                Log::warning("TodoistProjectUsersSyncAction couldn't proceed due to a missing non-nullable variable.");
                return false;
            }

            if ($id === $account->user->external_id) {
                return true;
            }

            $user = $this->userGetAction->handle($id, $emailAddress, $name);
            if (is_null($user)) {
                Log::warning("TodoistProjectUsersSyncAction failed due to failed call to TodoistUserGetAction.");
                return false;
            }

            $result = $this->projectUserAssociateAction->handle($project, $user);
            if (!$result) {
                Log::warning("TodoistProjectUsersSyncAction failed due to failed call to TodoistProjectUserDisassociateAction.");
                return false;
            }

            return true;
        })->reduce(function (bool $carry, bool $result) {
            return $carry && $result;
        }, true);

        if (!$result) {
            return false;
        }

        return true;
    }

    private function handleUnshared(TodoistAccount $account, TodoistProject $project): bool
    {
        $result = $project->users->map(function ($user) use ($account, $project) {
            if ($user->id === $account->user->id) {
                return true;
            }

            $result = $this->projectUserDisassociateAction->handle($project, $account->user);
            if (!$result) {
                Log::warning("TodoistProjectUsersSyncAction failed due to failed call to TodoistProjectUserDisassociateAction.");
                return false;
            }

            return true;
        })->reduce(function (bool $carry, bool $result) {
            return $carry && $result;
        }, true);

        if (!$result) {
            return false;
        }

        return true;
    }
}
