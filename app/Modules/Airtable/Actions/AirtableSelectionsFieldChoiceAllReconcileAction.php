<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableSelectionsFieldOptionsChoiceResourceResponseDto;
use App\Modules\Airtable\Models\AirtableSelectionsField;
use App\Modules\Airtable\Models\AirtableSelectionsFieldChoice;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class AirtableSelectionsFieldChoiceAllReconcileAction
{
    protected AirtableSelectionsFieldChoiceReconcileAction $selectionsFieldChoiceReconcileAction;

    protected AirtableSelectionsFieldChoiceAllTrashAction $selectionsFieldChoiceAllTrashAction;

    public function __construct()
    {
        $this->selectionsFieldChoiceReconcileAction = app(AirtableSelectionsFieldChoiceReconcileAction::class);

        $this->selectionsFieldChoiceAllTrashAction = app(AirtableSelectionsFieldChoiceAllTrashAction::class);
    }

    /**
     * @param Collection<AirtableSelectionsFieldOptionsChoiceResourceResponseDto> $selectionsFieldOptionsChoiceResourceResponseDtos
     * @return Collection<AirtableSelectionsFieldChoice>
     * @throws Exception
     */
    public function handle(Collection $selectionsFieldOptionsChoiceResourceResponseDtos, AirtableSelectionsField $selectionsField): Collection
    {
        Log::info('executing AirtableSelectionsFieldChoiceAllReconcileAction');

        $selectionsFieldOptionsChoiceResourceResponseDtos->each(function (AirtableSelectionsFieldOptionsChoiceResourceResponseDto $selectionsFieldOptionsChoiceResourceResponseDto, int $key) {
            $selectionsFieldOptionsChoiceResourceResponseDto->rank = $key + 1;
        });

        $selectionsFieldChoices = $selectionsFieldOptionsChoiceResourceResponseDtos->map(function (AirtableSelectionsFieldOptionsChoiceResourceResponseDto $selectionsFieldOptionsChoiceResourceResponseDto) use ($selectionsField) {
            return $this->selectionsFieldChoiceReconcileAction->handle($selectionsFieldOptionsChoiceResourceResponseDto, $selectionsField);
        });

        $trashableSelectionsFieldChoices = $selectionsField->choices()
            ->whereNotNull('external_id')
            ->whereNotIn('id', $selectionsFieldChoices->pluck('id'))
            ->get();
        $this->selectionsFieldChoiceAllTrashAction->handle($trashableSelectionsFieldChoices);

        return $selectionsFieldChoices;
    }
}
