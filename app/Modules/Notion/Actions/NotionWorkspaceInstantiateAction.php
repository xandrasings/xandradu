<?php

namespace App\Modules\Notion\Actions;

use App\Models\NotionWorkspace;
use App\Modules\Notion\Clients\NotionClient;
use App\Utilities\ValidationUtility;
use Illuminate\Support\Facades\Log;

class NotionWorkspaceInstantiateAction
{
    protected NotionClient $client;

    protected ValidationUtility $validationUtility;

    protected NotionWorkspaceSyncAction $workspaceSyncAction;

    public function __construct()
    {
        $this->client = app(NotionClient::class);
        $this->validationUtility = app(ValidationUtility::class);
        $this->workspaceSyncAction = app(NotionWorkspaceSyncAction::class);
    }

    public function handle(string $token): ?NotionWorkspace
    {
        $workspacePayload =$this->client->getUser($token);

        if (! $this->validationUtility->containsNoNulls([$workspacePayload])) {
            Log::warning("NotionWorkspaceInstantiateAction couldn't proceed due to failure from NotionClient");
            return null;
        }

        return $this->workspaceSyncAction->handle($workspacePayload, $token);
    }
}
