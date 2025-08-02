<?php

namespace App\Modules\Notion\Actions;

use App\Models\NotionBot;
use App\Modules\Notion\Clients\NotionClient;
use App\Utilities\ValidationUtility;
use Illuminate\Support\Facades\Log;
use Throwable;

class NotionBotInstantiateAction
{
    protected NotionClient $client;

    protected ValidationUtility $validationUtility;

    protected NotionWorkspaceGetAction $workspaceGetAction;

    public function __construct()
    {
        $this->client = app(NotionClient::class);
        $this->validationUtility = app(ValidationUtility::class);
        $this->workspaceGetAction = app (NotionWorkspaceGetAction::class);
    }

    public function handle(array $botPayload, string $label, string $token): ?NotionBot
    {
        $id = data_get($botPayload, 'id');
        $name = data_get($botPayload, 'name');
        $workspaceName = data_get($botPayload, 'bot.workspace_name');

        if (! $this->validationUtility->containsNoNulls([$id, $name, $workspaceName])) {
            Log::warning("NotionBotInstantiateAction couldn't proceed due to a missing non-nullable variable");
            return null;
        }

        $workspace = $this->workspaceGetAction->handle($workspaceName);

        if (! $this->validationUtility->containsNoNulls([$workspace])) {
            Log::warning("NotionBotInstantiateAction couldn't proceed due to a missing non-nullable variable");
            return null;
        }

        try {
            return NotionBot::create([
                'workspace_id' => $workspace->id,
                'external_id' => $id,
                'name' => $name,
                'label' => $label,
                'token' => $token,
            ]);
        } catch (Throwable $exception) {
            Log::warning("NotionWorkspaceSyncAction failed with exception {$exception->getMessage()}");
            return null;
        }
    }
}
