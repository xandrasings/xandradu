<?php

namespace App\Modules\Todoist\Actions;

use App\Models\TodoistAccount;
use App\Modules\Todoist\Clients\TodoistClient;

class TodoistAccountSyncAction
{
    protected TodoistClient $client;

    protected TodoistProjectsSyncAction $projectsSyncAction;

    protected TodoistSectionsSyncAction $sectionsSyncAction;

    public function __construct()
    {
        $this->client = app(TodoistClient::class);
        $this->projectsSyncAction = app(TodoistProjectsSyncAction::class);
        $this->sectionsSyncAction = app(TodoistSectionsSyncAction::class);
    }


    public function handle(TodoistAccount $account): void
    {
        $response =  $this->client->getLatestChanges($account);

        // TODO update account w sync token

        $projectsPayload = data_get($response, 'projects', []);
        $this->projectsSyncAction->handle($account, $projectsPayload);

        $sectionsPayload = data_get($response, 'sections', []);
        $this->sectionsSyncAction->handle($sectionsPayload);
    }
}
