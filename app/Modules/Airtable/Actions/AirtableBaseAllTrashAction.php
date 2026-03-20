<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Models\AirtableBase;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class AirtableBaseAllTrashAction
{
    protected AirtableBaseTrashAction $baseTrashAction;

    public function __construct()
    {
        $this->baseTrashAction = app(AirtableBaseTrashAction::class);
    }

    /**
     * @param  Collection<AirtableBase>  $bases
     *
     * @throws Exception
     */
    public function handle(Collection $bases): void
    {
        Log::info('executing AirtableBaseAllTrashAction');

        $bases->each(function (AirtableBase $base) {
            $this->baseTrashAction->handle($base);
        });
    }
}
