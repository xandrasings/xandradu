<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableSyncSourceFieldOptionsChoiceResourceResponseDto;
use App\Modules\Airtable\Models\AirtableSyncSourceField;
use App\Modules\Airtable\Models\AirtableSyncSourceFieldChoice;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class AirtableSyncSourceFieldOptionsChoiceAllReconcileAction
{
    protected AirtableSyncSourceFieldOptionsChoiceReconcileAction $syncSourceFieldOptionsChoiceReconcileAction;

    public function __construct()
    {
        $this->syncSourceFieldOptionsChoiceReconcileAction = app(AirtableSyncSourceFieldOptionsChoiceReconcileAction::class);
    }

    /**
     * @param Collection<AirtableSyncSourceFieldOptionsChoiceResourceResponseDto> $syncSourceFieldOptionsChoiceResourceResponseDtos
     * @return Collection<AirtableSyncSourceFieldChoice>
     * @throws Exception
     */
    public function handle(Collection $syncSourceFieldOptionsChoiceResourceResponseDtos, AirtableSyncSourceField $syncSourceField): Collection
    {
        Log::info('executing AirtableSyncSourceFieldOptionsChoiceAllReconcileAction');

        $syncSourceFieldOptionsChoiceResourceResponseDtos->each(function (AirtableSyncSourceFieldOptionsChoiceResourceResponseDto $syncSourceFieldOptionsChoiceResourceResponseDto, int $key) {
            $syncSourceFieldOptionsChoiceResourceResponseDto->rank = $key + 1;
        });

        $syncSourceFieldChoices = $syncSourceFieldOptionsChoiceResourceResponseDtos->map(function (AirtableSyncSourceFieldOptionsChoiceResourceResponseDto $syncSourceFieldOptionsChoiceResourceResponseDto) use ($syncSourceField) {
            return $this->syncSourceFieldOptionsChoiceReconcileAction->handle($syncSourceFieldOptionsChoiceResourceResponseDto, $syncSourceField);
        });

        $syncSourceField->choices()
            ->whereNotNull('external_id')
            ->whereNotIn('id', $syncSourceFieldChoices->pluck('id'))
            ->get()
            ->each(function (AirtableSyncSourceFieldChoice $syncSourceFieldChoice) {
                $syncSourceFieldChoice->delete();
                Log::notice('deleted AirtableSyncSourceFieldChoice.', ['syncSourceFieldChoice' => $syncSourceFieldChoice]);
            });

        return $syncSourceFieldChoices;
    }
}
