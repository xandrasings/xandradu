<?php

namespace App\Modules\Notion\Actions;

use App\Models\NotionNode;
use App\Models\NotionWorkspace;
use Illuminate\Support\Facades\Log;
use Throwable;

class NotionWorkspaceGetAction
{
    public function handle(string $name): ?NotionWorkspace
    {
        $workspaces = NotionWorkspace::where(['name' => $name])->get();

        if (count($workspaces) > 1) {
            Log::warning("NotionWorkspaceGetAction failed, found too many NotionWorkspace records matching name $name.");
            return null;
        }

        if ($workspaces->isEmpty()) {
            try {
                Log::notice("NotionWorkspaceGetAction creating NotionWorkspace $name");

                // TODO move as appropriate
                $node = NotionNode::create([]);

                return NotionWorkspace::create([
                    'node_id' => $node->id,
                    'name' => $name
                ]);
            } catch (Throwable $exception) {
                Log::warning("NotionWorkspaceGetAction failed with exception {$exception->getMessage()}");
                return null;
            }
        }

        return $workspaces->first();
    }
}
