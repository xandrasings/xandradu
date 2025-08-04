<?php

namespace App\Modules\Band\Actions;

use App\Models\Band;
use App\Models\BandWiki;
use App\Models\NotionWorkspace;
use App\Modules\Notion\Actions\NotionBotSelectAction;
use App\Modules\Notion\Actions\NotionPageSyncAction;
use Illuminate\Support\Facades\Log;
use Throwable;

class BandWikiCreateAction
{
    protected NotionBotSelectAction $botSelectAction;

    protected NotionPageSyncAction $notionPageSyncAction;

    public function __construct()
    {
        $this->botSelectAction = new NotionBotSelectAction();
        $this->notionPageSyncAction = app(NotionPageSyncAction::class);
    }

    public function handle(Band $band, NotionWorkspace $workspace, string $rootNodeId): ?Band // TODO xan
    {
        $bot = $this->botSelectAction->handle($workspace,  'xandradu');

        // TODO verify not null

        // TODO db check, page on fail

        $page = $this->notionPageSyncAction->handle($rootNodeId, $bot);

        $node = $page->node;

        // TODO move this
        try {
            BandWiki::create([
                'band_id' => $band->id,
                'notion_node_id' => $node->id,
            ]);
        } catch (Throwable $exception) {
            Log::warning("NotionPageInstantiateAction failed with exception {$exception->getMessage()}");
            return null;
        }

        return null;
    }
}
