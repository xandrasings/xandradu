<?php

namespace App\Modules\Notion\Services;

use App\Models\NotionBot;
use App\Modules\Notion\Actions\NotionBotCreateAction;

class NotionService
{
    protected NotionBotCreateAction $botCreateAction;

    public function __construct()
    {
        $this->botCreateAction = app(NotionBotCreateAction::class);
    }

    public function createBot(string $label, string $token): ?NotionBot
    {
        return $this->botCreateAction->handle($label, $token);
    }
}
