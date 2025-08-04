<?php

namespace App\Modules\Notion\Actions;

use App\Models\NotionPage;
use App\Models\NotionWorkspace;
use App\Modules\Notion\Clients\NotionClient;
use App\Utilities\ValidationUtility;
use Illuminate\Support\Facades\Log;

class NotionPageApplyAction
{
    protected NotionClient $client;

    protected ValidationUtility $validationUtility;

    protected NotionBotInstantiateAction $botInstantiateAction;

    protected NotionPageInstantiateAction $pageInstantiateAction;

    protected NotionPageUpdateAction $pageUpdateAction;

    public function __construct()
    {
        $this->client = app(NotionClient::class);
        $this->validationUtility = app(ValidationUtility::class);
        $this->botInstantiateAction = app(NotionBotInstantiateAction::class);
        $this->pageInstantiateAction = app(NotionPageInstantiateAction::class);
        $this->pageUpdateAction = app(NotionPageUpdateAction::class);
    }

    public function handle(array $payload, NotionWorkspace $workspace): ?NotionPage
    {
        $id = data_get($payload, 'id');

        if (! $this->validationUtility->containsNoNulls([$id])) {
            Log::warning("NotionPageApplyAction couldn't proceed due to a missing non-nullable variable");
            return null;
        }

        $id = str_replace('-', '', $id);

        $pages = NotionPage::where(['external_id' => $id])->get();

        // TODO consider in_trash and archived for potential soft delete trigger

        if (! $this->validationUtility->containsNoMoreThanOne($pages)) {
            Log::warning("NotionPageApplyAction couldn't proceed due to multiple NotionPages matching this external id.");
            return null;
        }

        if ($pages->isEmpty()) {
            return $this->pageInstantiateAction->handle($payload, $workspace);
        }

        $page = $pages->first();

        return $this->pageUpdateAction->handle($page, $payload);
    }
}
