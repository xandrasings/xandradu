<?php

namespace App\Modules\Notion\Actions;

use App\Modules\Notion\Models\NotionWorkspace;
use App\Utilities\ValidationUtility;
use Illuminate\Support\Facades\Log;
use Throwable;

class NotionWorkspaceInstantiateAction
{
    protected ValidationUtility $validationUtility;

    protected NotionNodeInstantiateAction $nodeInstantiateAction;

    public function __construct()
    {
        $this->validationUtility = app(ValidationUtility::class);
        $this->nodeInstantiateAction = app(NotionNodeInstantiateAction::class);
    }

    public function handle(string $name): ?NotionWorkspace
    {
        $node = $this->nodeInstantiateAction->handle();
        if (!$this->validationUtility->containsNoNulls([$node])) {
            Log::warning("NotionWorkspaceInstantiateAction couldn't proceed due to a missing non-nullable variable.");
            return null;
        }

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
