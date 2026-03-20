<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Models\AirtableSyncSourceFieldChoice;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class AirtableSyncSourceFieldChoiceAllTrashAction
{
    protected AirtableSyncSourceFieldChoiceTrashAction $syncSourceFieldChoiceTrashAction;

    public function __construct()
    {
        $this->syncSourceFieldChoiceTrashAction = app(AirtableSyncSourceFieldChoiceTrashAction::class);
    }

    /**
     * @param  Collection<AirtableSyncSourceFieldChoice>  $syncSourceFieldChoices
     *
     * @throws Exception
     */
    public function handle(Collection $syncSourceFieldChoices): void
    {
        Log::info('executing AirtableSyncSourceFieldChoiceAllTrashAction');

        $syncSourceFieldChoices->each(function (AirtableSyncSourceFieldChoice $syncSourceFieldChoice) {
            $this->syncSourceFieldChoiceTrashAction->handle($syncSourceFieldChoice);
        });
    }
}
