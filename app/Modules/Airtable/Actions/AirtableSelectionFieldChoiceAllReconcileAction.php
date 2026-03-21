<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableSelectionFieldOptionsChoiceResourceResponseDto;
use App\Modules\Airtable\Models\AirtableSelectionField;
use App\Modules\Airtable\Models\AirtableSelectionFieldChoice;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class AirtableSelectionFieldChoiceAllReconcileAction
{
    protected AirtableSelectionFieldChoiceReconcileAction $selectionFieldChoiceReconcileAction;

    protected AirtableSelectionFieldChoiceAllTrashAction $selectionFieldChoiceAllTrashAction;

    public function __construct()
    {
        $this->selectionFieldChoiceReconcileAction = app(AirtableSelectionFieldChoiceReconcileAction::class);

        $this->selectionFieldChoiceAllTrashAction = app(AirtableSelectionFieldChoiceAllTrashAction::class);
    }

    /**
     * @param Collection<AirtableSelectionFieldOptionsChoiceResourceResponseDto> $selectionFieldOptionsChoiceResourceResponseDtos
     * @return Collection<AirtableSelectionFieldChoice>
     *
     * @throws Exception
     */
    public function handle(Collection $selectionFieldOptionsChoiceResourceResponseDtos, AirtableSelectionField $selectionField): Collection
    {
        Log::info('executing AirtableSelectionFieldChoiceAllReconcileAction');

        $selectionFieldOptionsChoiceResourceResponseDtos
            ->each(function (AirtableSelectionFieldOptionsChoiceResourceResponseDto $selectionFieldOptionsChoiceResourceResponseDto, int $key) {
                $selectionFieldOptionsChoiceResourceResponseDto->rank = $key + 1;
            });

        $selectionFieldChoices = $selectionFieldOptionsChoiceResourceResponseDtos
            ->map(function (AirtableSelectionFieldOptionsChoiceResourceResponseDto $selectionFieldOptionsChoiceResourceResponseDto) use ($selectionField) {
                return $this->selectionFieldChoiceReconcileAction->handle($selectionFieldOptionsChoiceResourceResponseDto, $selectionField);
            });

        $trashableSelectionFieldChoices = $selectionField->choices()
            ->whereNotNull('external_id')
            ->whereNotIn('id', $selectionFieldChoices->pluck('id'))
            ->get();
        $this->selectionFieldChoiceAllTrashAction->handle($trashableSelectionFieldChoices);

        return $selectionFieldChoices;
    }
}
