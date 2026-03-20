<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Models\AirtableSelectionsFieldChoice;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class AirtableSelectionsFieldChoiceAllTrashAction
{
    protected AirtableSelectionsFieldChoiceTrashAction $selectionsFieldChoiceTrashAction;

    public function __construct()
    {
        $this->selectionsFieldChoiceTrashAction = app(AirtableSelectionsFieldChoiceTrashAction::class);
    }

    /**
     * @param  Collection<AirtableSelectionsFieldChoice>  $selectionsFieldChoices
     *
     * @throws Exception
     */
    public function handle(Collection $selectionsFieldChoices): void
    {
        Log::info('executing AirtableSelectionsFieldChoiceAllTrashAction');

        $selectionsFieldChoices->each(function (AirtableSelectionsFieldChoice $selectionsFieldChoice) {
            $this->selectionsFieldChoiceTrashAction->handle($selectionsFieldChoice);
        });
    }
}
