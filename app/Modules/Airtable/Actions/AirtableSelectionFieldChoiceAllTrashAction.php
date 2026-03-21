<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Models\AirtableSelectionFieldChoice;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class AirtableSelectionFieldChoiceAllTrashAction
{
    protected AirtableSelectionFieldChoiceTrashAction $selectionFieldChoiceTrashAction;

    public function __construct()
    {
        $this->selectionFieldChoiceTrashAction = app(AirtableSelectionFieldChoiceTrashAction::class);
    }

    /**
     * @param  Collection<AirtableSelectionFieldChoice>  $selectionFieldChoices
     *
     * @throws Exception
     */
    public function handle(Collection $selectionFieldChoices): void
    {
        Log::info('executing AirtableSelectionFieldChoiceAllTrashAction');

        $selectionFieldChoices
            ->each(function (AirtableSelectionFieldChoice $selectionFieldChoice) {
                $this->selectionFieldChoiceTrashAction->handle($selectionFieldChoice);
            });
    }
}
