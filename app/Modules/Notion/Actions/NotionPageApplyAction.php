<?php

namespace App\Modules\Notion\Actions;

use App\Models\NotionPage;
use App\Models\NotionWorkspace;
use App\Utilities\ValidationUtility;
use Illuminate\Support\Facades\Log;

class NotionPageApplyAction
{
    protected ValidationUtility $validationUtility;

    protected NotionPageExistsAction $pageExistsAction;

    protected NotionPageSelectAction $pageSelectAction;

    protected NotionPageInstantiateAction $pageInstantiateAction;

    protected NotionPageUpdateAction $pageUpdateAction;

    public function __construct()
    {
        $this->validationUtility = app(ValidationUtility::class);
        $this->pageExistsAction = app(NotionPageExistsAction::class);
        $this->pageSelectAction = app(NotionPageSelectAction::class);
        $this->pageInstantiateAction = app(NotionPageInstantiateAction::class);
        $this->pageUpdateAction = app(NotionPageUpdateAction::class);
    }

    public function handle(array $payload, NotionWorkspace $workspace): ?NotionPage
    {
        $id = data_get($payload, 'id');
        if (! $this->validationUtility->containsNoNulls([$id])) {
            Log::warning("NotionPageApplyAction couldn't proceed due to a missing non-nullable variable.");
            return null;
        }
        $id = str_replace('-', '', $id);

        if ($this->pageExistsAction->handle($id)) {
            $page = $this->pageSelectAction->handle($id);
            if (!$this->validationUtility->containsNoNulls([$page])) {
                Log::warning("NotionPageApplyAction couldn't proceed due to a missing non-nullable variable.");
                return null;
            }

            return $this->pageUpdateAction->handle($page, $payload);
        }

        return $this->pageInstantiateAction->handle($payload, $workspace);
    }
}
