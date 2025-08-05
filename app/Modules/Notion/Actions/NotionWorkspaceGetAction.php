<?php

namespace App\Modules\Notion\Actions;

use App\Modules\Notion\Models\NotionWorkspace;
use App\Utilities\ValidationUtility;
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

    public function handle(string $name): ?NotionWorkspace
    {
        $workspaces = NotionWorkspace::where([
            'name' => $name
        ])->get();

        if (count($workspaces) > 1) {
            Log::warning("NotionWorkspaceGetAction failed, found too many NotionWorkspace records matching name $name.");
            return null;
        }

        if ($workspaces->isEmpty()) {
            return $this->workspaceInstantiateAction->handle($name);
        }

        return $workspaces->first();
    }
}
