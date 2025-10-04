<?php

namespace App\Modules\Notion\Actions;

use App\Modules\Notion\Models\NotionWorkspace;
use App\Utilities\ValidationUtility;
use Exception;
use Illuminate\Support\Facades\Log;

class NotionWorkspaceInstantiateAction
{
    protected ValidationUtility $validationUtility;

    protected NotionNodeInstantiateAction $nodeInstantiateAction;

    public function __construct()
    {
        $this->validationUtility = app(ValidationUtility::class);
        $this->nodeInstantiateAction = app(NotionNodeInstantiateAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(string $name): NotionWorkspace
    {
        $node = $this->nodeInstantiateAction->handle();
        if (!$this->validationUtility->containsNoNulls([$node])) {
            throw new Exception("NotionWorkspaceInstantiateAction couldn't proceed due to a missing non-nullable variable.");
        }

        Log::notice("NotionWorkspaceInstantiateAction creating NotionWorkspace from NotionNode $node->id, name $name.");
        return NotionWorkspace::create([
            'node_id' => $node->id,
            'name' => $name
        ]);
    }
}
