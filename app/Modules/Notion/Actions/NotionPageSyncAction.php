<?php

namespace App\Modules\Notion\Actions;

use App\Modules\Notion\Clients\NotionClient;
use App\Modules\Notion\Models\NotionPage;
use App\Modules\Notion\Models\NotionWorkspace;
use App\Utilities\ValidationUtility;
use Exception;
use Illuminate\Support\Facades\Log;

class NotionPageSyncAction
{
    protected NotionBotSelectAction $botSelectAction;

    protected NotionClient $client;

    protected ValidationUtility $validationUtility;

    protected NotionPageApplyAction $pageApplyAction;

    public function __construct()
    {
        $this->botSelectAction = new NotionBotSelectAction();
        $this->client = app(NotionClient::class);
        $this->validationUtility = app(ValidationUtility::class);
        $this->pageApplyAction = app(NotionPageApplyAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(string $id, NotionWorkspace $workspace): NotionPage
    {
        $bot = $this->botSelectAction->handle($workspace, 'xandradu');

        if (!$this->validationUtility->containsNoNulls([$bot])) {
            throw new Exception("NotionPageSyncAction couldn't proceed due to a missing non-nullable variable.");
        }

        $payload = $this->client->getPage($id, $bot);

        if (!$this->validationUtility->containsNoNulls([$payload])) {
            throw new Exception("NotionPageSyncAction couldn't proceed due to failure from NotionClient");
        }

        return $this->pageApplyAction->handle($payload, $workspace);
    }
}
