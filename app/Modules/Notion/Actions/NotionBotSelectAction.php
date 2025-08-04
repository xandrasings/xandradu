<?php

namespace App\Modules\Notion\Actions;

use App\Models\NotionBot;
use App\Models\NotionWorkspace;
use Illuminate\Support\Facades\Log;

class NotionBotSelectAction
{
    public function handle(NotionWorkspace $workspace, string $label): ?NotionBot
    {
        $bots = $workspace->bots()->where([
            'label' => $label
        ])->get();

        if ($bots->count() > 1) {
            Log::warning("NotionBotSelectAction failed because multiple NotionBots with label $label exist for NotionWorkspace $workspace->id.");
            return null;
        }

        if ($bots->isEmpty()) {
            Log::warning("NotionBotSelectAction failed because no NotionBots with label $label exist for NotionWorkspace $workspace->id.");
            return null;
        }

        return $bots->first();
    }
}
