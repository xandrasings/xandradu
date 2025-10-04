<?php

namespace App\Modules\Notion\Actions;

use App\Modules\Notion\Models\NotionWorkspace;
use App\Utilities\ValidationUtility;
use Exception;
use Illuminate\Support\Facades\Log;

class NotionWorkspaceGetAction
{
    protected ValidationUtility $validationUtility;

    protected NotionWorkspaceInstantiateAction $workspaceInstantiateAction;

    public function __construct()
    {
        $this->validationUtility = app(ValidationUtility::class);
        $this->workspaceInstantiateAction = app(NotionWorkspaceInstantiateAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(string $name): NotionWorkspace
    {
        $workspaces = NotionWorkspace::where([
            'name' => $name
        ])->get();

        if (count($workspaces) > 1) {
            throw new Exception("NotionWorkspaceGetAction failed, found too many NotionWorkspace records matching name $name.");
        }

        if ($workspaces->isEmpty()) {
            return $this->workspaceInstantiateAction->handle($name);
        }

        return $workspaces->first();
    }
}
