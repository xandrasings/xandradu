<?php

namespace App\Modules\Notion\Services;

use App\Modules\Notion\Actions\NotionBotCreateAction;
use App\Modules\Notion\Actions\NotionWorkspaceSelectAction;
use App\Modules\Notion\Models\NotionBot;
use App\Modules\Notion\Models\NotionWorkspace;

class NotionService
{
    protected NotionBotCreateAction $botCreateAction;

    protected NotionWorkspaceSelectAction $workspaceSelectAction;

    public function __construct()
    {
        $this->botCreateAction = app(NotionBotCreateAction::class);
        $this->workspaceSelectAction = app(NotionWorkspaceSelectAction::class);
    }

    public function createBot(string $label, string $token): ?NotionBot
    {
        return $this->botCreateAction->handle($label, $token);
    }

    public function selectWorkspace(string $name): ?NotionWorkspace
    {
        return $this->workspaceSelectAction->handle($name);
    }
}
