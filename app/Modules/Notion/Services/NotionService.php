<?php

namespace App\Modules\Notion\Services;

use App\Models\NotionWorkspace;
use App\Modules\Notion\Actions\NotionWorkspaceInstantiateAction;

class NotionService
{
    protected NotionWorkspaceInstantiateAction $workspaceInstantiateAction;

    public function __construct()
    {
        $this->workspaceInstantiateAction = app(NotionWorkspaceInstantiateAction::class);
    }

    public function instantiateNotionWorkspace(string $token): ?NotionWorkspace
    {
        return $this->workspaceInstantiateAction->handle($token);
    }
}
