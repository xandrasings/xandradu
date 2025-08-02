<?php

namespace App\Modules\Notion\Actions;

use App\Models\NotionBot;
use App\Models\NotionWorkspace;
use App\Modules\Notion\Clients\NotionClient;
use App\Utilities\ValidationUtility;
use Illuminate\Support\Facades\Log;

class NotionBotCreateAction
{
    protected NotionClient $client;

    protected ValidationUtility $validationUtility;

    protected NotionBotInstantiateAction $botInstantiateAction;

    public function __construct()
    {
        $this->client = app(NotionClient::class);
        $this->validationUtility = app(ValidationUtility::class);
        $this->botInstantiateAction = app(NotionBotInstantiateAction::class);
    }

    public function handle(string $label, string $token): ?NotionBot
    {
        $botPayload =$this->client->getUser($token); // TODO rename and refactor

        if (! $this->validationUtility->containsNoNulls([$botPayload])) {
            Log::warning("NotionWorkspaceInstantiateAction couldn't proceed due to failure from NotionClient");
            return null;
        }

        return $this->botInstantiateAction->handle($botPayload, $label, $token);
    }
}
