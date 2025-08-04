<?php

namespace App\Modules\Notion\Actions;

use App\Models\NotionNode;
use App\Models\NotionWorkspace;
use Illuminate\Support\Facades\Log;
use Throwable;

class NotionWorkspaceInstantiateAction
{
    public function handle(NotionNode $node, string $name): ?NotionWorkspace
    {
        try {
            Log::notice("NotionWorkspaceInstantiateAction creating NotionWorkspace from NotionNode $node->id, name $name.");
            return NotionWorkspace::create([
                'node_id' => $node->id,
                'name' => $name
            ]);
        } catch (Throwable $exception) {
            Log::warning("NotionWorkspaceInstantiateAction failed with exception {$exception->getMessage()}.");
            return null;
        }
    }
}
