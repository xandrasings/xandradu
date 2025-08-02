<?php

namespace App\Modules\Notion\Actions;

use App\Models\NotionWorkspace;
use Illuminate\Support\Facades\Log;

class NotionWorkspaceSelectAction
{
    public function handle(string $name): ?NotionWorkspace
    {
        $workspace = NotionWorkspace::where([
            'name' => $name,
        ])->get();

        if ($workspace->count() > 1) {
            Log::warning("NotionWorkspaceSelectAction failed because multiple NotionWorkspace records exist with name $name.");
            return null;
        }

        if($workspace->isEmpty()) {
            Log::warning("NotionWorkspaceSelectAction failed because no NotionWorkspace records exist with name $name.");
            return null;
        }

        return $workspace->first();
    }
}
