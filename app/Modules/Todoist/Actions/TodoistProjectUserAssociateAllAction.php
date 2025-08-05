<?php

namespace App\Modules\Todoist\Actions;

use App\Actions\EmailAddressGetAction;
use App\Models\TodoistAccount;
use App\Models\TodoistProject;
use App\Modules\Todoist\Clients\TodoistClient;
use App\Utilities\ValidationUtility;
use Illuminate\Support\Facades\Log;

class TodoistProjectUserAssociateAllAction
{
    protected TodoistClient $client;

    protected ValidationUtility $validationUtility;

    protected TodoistProjectUserDisassociateAction $projectUserDisassociateAction;

    protected EmailAddressGetAction $emailAddressGetAction;

    protected TodoistUserGetAction $userGetAction;

    protected TodoistProjectUserAssociateAction $projectUserAssociateAction;

    public function __construct()
    {
        $this->client = app(TodoistClient::class);
        $this->validationUtility = app(ValidationUtility::class);
        $this->projectUserDisassociateAction = app(TodoistProjectUserDisassociateAction::class);
        $this->emailAddressGetAction = app(EmailAddressGetAction::class);
        $this->userGetAction = app(TodoistUserGetAction::class);
        $this->projectUserAssociateAction = app(TodoistProjectUserAssociateAction::class);
    }

    public function handle(TodoistAccount $account, TodoistProject $project, ?TodoistProject $accountParentProject, int $accountChildOrder): bool
    {
        $payloads = $this->client->getProjectUsers($project, $account);
        if (!$this->validationUtility->containsNoNulls([$payloads])) {
            Log::warning("TodoistProjectUserAssociateAllAction couldn't proceed due to a missing non-nullable variable.");
            return false;
        }

        $result = $project->users->map(function ($user) use ($payloads, $project) {
            if ($payloads->map(function ($payload) use ($project) {
                return data_get($payload, 'id');
            })->contains($user->external_id)) {
                return true;
            }

            return $this->projectUserDisassociateAction->handle($project, $user);
        })->reduce(function (bool $carry, bool $result) {
            return $carry && $result;
        }, true);

        if (!$result) {
            Log::warning("TodoistProjectUserAssociateAllAction failed due to failed call to TodoistProjectUserDisassociateAction.");
            return false;
        }

        $result = $payloads->map(function ($payload) use ($account, $accountParentProject, $accountChildOrder, $project) {
            $id = data_get($payload, 'id');
            $email = data_get($payload, 'email');
            $name = data_get($payload, 'name');
            if (!$this->validationUtility->containsNoNulls([$id, $email, $name])) {
                return false;
            }

            if ($id === $account->user->external_id) {
                $user = $account->user;
                $parentProject = $accountParentProject;
                $childOrder = $accountChildOrder;
            } else {
                $emailAddress = $this->emailAddressGetAction->handle($email);
                if (!$this->validationUtility->containsNoNulls([$emailAddress])) {
                    return null;
                }

                $user = $this->userGetAction->handle($id, $emailAddress, $name);
                if (is_null($user)) {
                    return false;
                }

                $parentProject = null;
                $childOrder = 0;
            }

            return $this->projectUserAssociateAction->handle($project, $user, $parentProject, $childOrder);
        })->reduce(function (bool $carry, bool $result) {
            return $carry && $result;
        }, true);

        if (!$result) {
            Log::warning("TodoistProjectUserAssociateAllAction failed due to failed call to TodoistProjectUserAssociateAction.");
            return false;
        }

        return true;
    }
}
