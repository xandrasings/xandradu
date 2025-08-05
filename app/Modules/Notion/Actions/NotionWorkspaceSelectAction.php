<?php

namespace App\Modules\Notion\Actions;

use App\Modules\Notion\Models\NotionWorkspace;
use Illuminate\Support\Facades\Log;

class NotionWorkspaceSelectAction
{
    public function handle(string $name): ?NotionWorkspace
    {
        $workspaces = NotionWorkspace::where([
            'name' => $name
        ])->get();

        if (count($workspaces) > 1) {
            Log::warning("NotionWorkspaceSelectAction failed because too many workspaces with name $name exist.");
            return null;
        }

        if ($workspaces->isEmpty()) {
            Log::warning("NotionWorkspaceSelectAction failed because no workspaces with name $name exist.");
            return null;
        }

        return $workspaces->first();
    }
}
