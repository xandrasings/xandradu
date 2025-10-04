<?php

namespace App\Modules\Notion\Actions;

use App\Modules\Notion\Models\NotionWorkspace;
use Exception;

class NotionWorkspaceSelectAction
{
    /**
     * @throws Exception
     */
    public function handle(string $name): NotionWorkspace
    {
        $workspaces = NotionWorkspace::where([
            'name' => $name
        ])->get();

        if (count($workspaces) > 1) {
            throw new Exception("NotionWorkspaceSelectAction failed because too many workspaces with name $name exist.");
        }

        if ($workspaces->isEmpty()) {
            throw new Exception("NotionWorkspaceSelectAction failed because no workspaces with name $name exist.");
        }

        return $workspaces->first();
    }
}
