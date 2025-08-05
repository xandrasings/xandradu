<?php

namespace App\Modules\Band\Actions;

use App\Modules\Band\Models\Band;
use App\Modules\Band\Models\BandWiki;
use App\Modules\Notion\Actions\NotionPageSyncAction;
use App\Modules\Notion\Models\NotionWorkspace;

class BandWikiCreateAction
{
    protected NotionPageSyncAction $notionPageSyncAction;

    protected BandWikiInstantiateAction $wikiInstantiateAction;

    public function __construct()
    {
        $this->notionPageSyncAction = app(NotionPageSyncAction::class);
        $this->wikiInstantiateAction = app(BandWikiInstantiateAction::class);
    }

    public function handle(Band $band, NotionWorkspace $workspace, string $rootNodeId): ?BandWiki
    {

        // TODO db vs page check, page on fail

        $page = $this->notionPageSyncAction->handle($rootNodeId, $workspace);

        return $this->wikiInstantiateAction->handle($band, $page->node);
    }
}
