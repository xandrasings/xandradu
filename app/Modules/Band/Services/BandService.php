<?php

namespace App\Modules\Band\Services;

use App\Models\Band;
use App\Models\NotionWorkspace;
use App\Modules\Band\Actions\BandCreateAction;
use App\Modules\Band\Actions\BandExistsAction;
use App\Modules\Band\Actions\BandSelectAction;
use App\Modules\Band\Actions\BandWikiCreateAction;

class BandService
{

    protected BandExistsAction $existsAction;

    protected BandCreateAction $createAction;

    protected BandSelectAction $selectAction;

    protected BandWikiCreateAction $wikiCreateAction;

    public function __construct()
    {
        $this->existsAction = app(BandExistsAction::class);
        $this->createAction = app (BandCreateAction::class);
        $this->selectAction = app (BandSelectAction::class);
        $this->wikiCreateAction = app (BandWikiCreateAction::class);

    }

    public function bandExists(string $name): bool
    {
        return $this->existsAction->handle($name);
    }

    public function createBand(string $name): ?Band
    {
        return $this->createAction->handle($name);
    }

    public function selectBand(string $name): ?Band
    {
        return $this->selectAction->handle($name);
    }

    public function createWiki(Band $band, NotionWorkspace $workspace, string $rootNodeId): ?Band
    {
        return $this->wikiCreateAction->handle($band, $workspace, $rootNodeId);
    }
}
