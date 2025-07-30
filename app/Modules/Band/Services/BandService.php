<?php

namespace App\Modules\Band\Services;

use App\Models\Band;
use App\Modules\Band\Actions\BandCreateAction;
use App\Modules\Band\Actions\BandExistsAction;

class BandService
{

    protected BandExistsAction $existsAction;

    protected BandCreateAction $createAction;

    public function __construct()
    {
        $this->existsAction = app(BandExistsAction::class);
        $this->createAction = app (BandCreateAction::class);

    }

    public function bandExists(string $name): bool
    {
        return $this->existsAction->handle($name);
    }

    public function createBand(string $name): ?Band
    {
        return $this->createAction->handle($name);
    }
}
