<?php

namespace App\Modules\Todoist\Actions;

use App\Models\TodoistAccount;
use App\Modules\Todoist\Clients\TodoistClient;
use App\Utilities\ValidationUtility;
use Illuminate\Support\Facades\Log;

class TodoistAccountSyncAction
{
    protected TodoistClient $client;

    protected ValidationUtility $validationUtility;

    protected TodoistProjectApplyAllAction $projectApplyAllAction;

    protected TodoistSectionApplyAllAction $sectionApplyAllAction;

    public function __construct()
    {
        $this->client = app(TodoistClient::class);
        $this->validationUtility = app(ValidationUtility::class);
        $this->projectApplyAllAction = app(TodoistProjectApplyAllAction::class);
        $this->sectionApplyAllAction = app(TodoistSectionApplyAllAction::class);
    }

    public function handle(TodoistAccount $account): bool
    {
        $payload = $this->client->getLatestChanges($account);
        if (!$this->validationUtility->containsNoNulls([$payload])) {
            Log::warning("TodoistAccountSyncAction couldn't proceed due to a missing non-nullable variable.");
            return false;
        }

        $result = $this->projectApplyAllAction->handle($account, data_get($payload, 'projects', []));
        if (!$result) {
            Log::warning("TodoistAccountSyncAction failed due to failure of ProjectApplyAllAction.");
            return false;
        }

        $this->sectionApplyAllAction->handle(data_get($payload, 'sections', []));
        if (!$result) {
            Log::warning("TodoistAccountSyncAction failed due to failure of SectionApplyAllAction.");
            return false;
        }

        return true;
    }
}
