<?php

namespace App\Modules\Band\Actions;

use App\Models\Band;
use App\Models\BandWiki;
use App\Models\NotionWorkspace;
use App\Modules\Notion\Actions\NotionPageSyncAction;

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

        $bandWiki = $this->wikiInstantiateAction->handle($band, $page->node);

        // TODO null check

        // TODO build up the wiki

        return $bandWiki;
    }
}
