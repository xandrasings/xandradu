<?php

namespace App\Modules\Band\Services;

use App\Modules\Band\Actions\BandCreateAction;
use App\Modules\Band\Actions\BandExistsAction;
use App\Modules\Band\Actions\BandSelectAction;
use App\Modules\Band\Actions\BandWikiCreateAction;
use App\Modules\Band\Actions\BandWikiRealizeAction;
use App\Modules\Band\Models\Band;
use App\Modules\Band\Models\BandWiki;
use App\Modules\Notion\Models\NotionWorkspace;
use Exception;

class BandService
{

    protected BandExistsAction $existsAction;

    protected BandCreateAction $createAction;

    protected BandSelectAction $selectAction;

    protected BandWikiCreateAction $wikiCreateAction;

    protected BandWikiRealizeAction $wikiRealizeAction;

    public function __construct()
    {
        $this->existsAction = app(BandExistsAction::class);
        $this->createAction = app (BandCreateAction::class);
        $this->selectAction = app (BandSelectAction::class);
        $this->wikiCreateAction = app (BandWikiCreateAction::class);
        $this->wikiRealizeAction = app(BandWikiRealizeAction::class);

    }

    public function bandExists(string $name): bool
    {
        return $this->existsAction->handle($name);
    }

    /**
     * @throws Exception
     */
    public function createBand(string $name): Band
    {
        return $this->createAction->handle($name);
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
        $this->wikiRealizeAction->handle($wiki);
        return $wiki;
    }
}
