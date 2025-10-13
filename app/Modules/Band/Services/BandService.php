<?php

namespace App\Modules\Band\Services;

use App\Modules\Band\Actions\BandInstantiateAction;
use App\Modules\Band\Actions\BandExistsAction;
use App\Modules\Band\Actions\BandSelectAction;
use App\Modules\Band\Actions\BandWikiCreateAction;
use App\Modules\Band\Actions\BandWikiSyncUpAction;
use App\Modules\Band\Models\Band;
use App\Modules\Band\Models\BandWiki;
use App\Modules\Notion\Models\NotionWorkspace;
use Exception;

class BandService
{

    protected BandExistsAction $existsAction;

    protected BandInstantiateAction $instantiateAction;

    protected BandSelectAction $selectAction;

    protected BandWikiCreateAction $wikiCreateAction;

    protected BandWikiSyncUpAction $wikiSyncUpAction;

    public function __construct()
    {
        $this->existsAction = app(BandExistsAction::class);
        $this->instantiateAction = app (BandInstantiateAction::class);
        $this->selectAction = app (BandSelectAction::class);
        $this->wikiCreateAction = app (BandWikiCreateAction::class);
        $this->wikiSyncUpAction = app(BandWikiSyncUpAction::class);

    }

    public function bandExists(string $name): bool
    {
        return $this->existsAction->handle($name);
    }

    /**
     * @throws Exception
     */
    public function instantiateBand(string $name): Band
    {
        return $this->instantiateAction->handle($name);
    }

    public function selectBand(string $name): ?Band
    {
        return $this->selectAction->handle($name);
    }

    /**
     * @throws Exception
     */
    public function manifestWiki(Band $band, NotionWorkspace $workspace, string $rootNodeId): BandWiki
    {
        $wiki = $this->wikiCreateAction->handle($band, $workspace, $rootNodeId);
        $this->wikiSyncUpAction->handle($wiki);
        return $wiki;
    }

    /**
     * @throws Exception
     */
    public function syncUpWiki(BandWiki $wiki): void
    {

    }
}
