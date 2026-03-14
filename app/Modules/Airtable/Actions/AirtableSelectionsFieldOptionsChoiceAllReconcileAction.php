<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableSelectionsFieldOptionsChoiceResourceResponseDto;
use App\Modules\Airtable\Models\AirtableSelectionsField;
use App\Modules\Airtable\Models\AirtableSelectionsFieldChoice;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class AirtableSelectionsFieldOptionsChoiceAllReconcileAction
{
    protected AirtableSelectionsFieldOptionsChoiceReconcileAction $selectionsFieldOptionsChoiceReconcileAction;

    public function __construct()
    {
        $this->selectionsFieldOptionsChoiceReconcileAction = app(AirtableSelectionsFieldOptionsChoiceReconcileAction::class);
    }

    /**
     * @param Collection<AirtableSelectionsFieldOptionsChoiceResourceResponseDto> $tableResourceResponseDtos
     * @return Collection<AirtableSelectionsFieldChoice>
     * @throws Exception
     */
    public function handle(Collection $tableResourceResponseDtos, AirtableSelectionsField $selectionsField): Collection
    {
        Log::info('executing AirtableSelectionsFieldOptionsChoiceAllReconcileAction');

        $selectionsFieldChoices = $tableResourceResponseDtos->map(function (AirtableSelectionsFieldOptionsChoiceResourceResponseDto $selectionsFieldOptionsChoiceResourceResponseDto) use ($selectionsField) {
            return $this->selectionsFieldOptionsChoiceReconcileAction->handle($selectionsFieldOptionsChoiceResourceResponseDto, $selectionsField);
        });

        $selectionsField->choices()
            ->whereNotNull('external_id')
            ->whereNotIn('id', $selectionsFieldChoices->pluck('id'))
            ->get()
            ->each(function (AirtableSelectionsFieldChoice $selectionsFieldChoice) {
                $selectionsFieldChoice->delete();
                Log::notice('deleted AirtableSelectionsFieldChoice.', ['selectionsFieldChoice' => $selectionsFieldChoice]);
            });

        return $selectionsFieldChoices;
    }
}
