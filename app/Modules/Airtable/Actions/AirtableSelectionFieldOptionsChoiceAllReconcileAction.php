<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableSelectionFieldOptionsChoiceResourceResponseDto;
use App\Modules\Airtable\Models\AirtableSelectionField;
use App\Modules\Airtable\Models\AirtableSelectionFieldChoice;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class AirtableSelectionFieldOptionsChoiceAllReconcileAction
{
    protected AirtableSelectionFieldOptionsChoiceReconcileAction $selectionFieldOptionsChoiceReconcileAction;

    public function __construct()
    {
        $this->selectionFieldOptionsChoiceReconcileAction = app(AirtableSelectionFieldOptionsChoiceReconcileAction::class);
    }

    /**
     * @param Collection<AirtableSelectionFieldOptionsChoiceResourceResponseDto> $tableResourceResponseDtos
     * @return Collection<AirtableSelectionFieldChoice>
     * @throws Exception
     */
    public function handle(Collection $tableResourceResponseDtos, AirtableSelectionField $selectionField): Collection
    {
        Log::info('executing AirtableSelectionFieldOptionsChoiceAllReconcileAction');

        $selectionFieldChoices = $tableResourceResponseDtos->map(function (AirtableSelectionFieldOptionsChoiceResourceResponseDto $selectionFieldOptionsChoiceResourceResponseDto) use ($selectionField) {
            return $this->selectionFieldOptionsChoiceReconcileAction->handle($selectionFieldOptionsChoiceResourceResponseDto, $selectionField);
        });

        $selectionField->choices()
            ->whereNotNull('external_id')
            ->whereNotIn('id', $selectionFieldChoices->pluck('id'))
            ->get()
            ->each(function (AirtableSelectionFieldChoice $selectionFieldChoice) {
                $selectionFieldChoice->delete();
                Log::notice('deleted AirtableSelectionFieldChoice.', ['selectionFieldChoice' => $selectionFieldChoice]);
            });

        return $selectionFieldChoices;
    }
}
