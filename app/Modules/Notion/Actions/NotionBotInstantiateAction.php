<?php

namespace App\Modules\Notion\Actions;

use App\Modules\Notion\Models\NotionBot;
use App\Utilities\ValidationUtility;
use Exception;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class NotionBotInstantiateAction
{
    protected ValidationUtility $validationUtility;

    protected NotionWorkspaceGetAction $workspaceGetAction;

    public function __construct()
    {
        $this->validationUtility = app(ValidationUtility::class);
        $this->workspaceGetAction = app (NotionWorkspaceGetAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(array $botPayload, string $label, string $token): ?NotionBot
    {
        $id = data_get($botPayload, 'id');
        $name = data_get($botPayload, 'name');
        $workspaceName = data_get($botPayload, 'bot.workspace_name');
        if (!$this->validationUtility->containsNoNulls([$id, $name, $workspaceName])) {
            throw new Exception("NotionBotInstantiateAction couldn't proceed due to a missing non-nullable variable.");
        }

        $workspace = $this->workspaceGetAction->handle($workspaceName);

        Log::notice("NotionBotInstantiateAction creating NotionBot from NotionWorkspace $workspace->id, external id $id, name $name, and label $label.");
        return NotionBot::create([
            'workspace_id' => $workspace->id,
            'external_id' => $id,
            'name' => $name,
            'label' => $label,
            'token' => Crypt::encryptString($token),
        ]);
    }
}
