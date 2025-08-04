<?php

namespace App\Modules\Notion\Actions;

use App\Models\NotionBot;
use App\Models\NotionPage;
use App\Modules\Notion\Clients\NotionClient;
use App\Utilities\ValidationUtility;
use Illuminate\Support\Facades\Log;

class NotionPageSyncAction
{
    protected NotionClient $client;

    protected ValidationUtility $validationUtility;

    protected NotionPageApplyAction $pageApplyAction;

    public function __construct()
    {
        $this->client = app(NotionClient::class);
        $this->validationUtility = app(ValidationUtility::class);
        $this->pageApplyAction = app(NotionPageApplyAction::class);
    }

    public function handle(string $id, NotionBot $bot): ?NotionPage
    {
        $payload =$this->client->getPage($id, $bot);

        if (! $this->validationUtility->containsNoNulls([$payload])) {
            Log::warning("NotionPageSyncAction couldn't proceed due to failure from NotionClient");
            return null;
        }

        return $this->pageApplyAction->handle($payload);
    }
}
