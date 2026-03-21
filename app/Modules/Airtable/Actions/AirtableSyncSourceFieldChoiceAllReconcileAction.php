<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableSyncSourceFieldOptionsChoiceResourceResponseDto;
use App\Modules\Airtable\Models\AirtableSyncSourceField;
use App\Modules\Airtable\Models\AirtableSyncSourceFieldChoice;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class AirtableSyncSourceFieldChoiceAllReconcileAction
{
    protected AirtableSyncSourceFieldChoiceReconcileAction $syncSourceFieldChoiceReconcileAction;

    protected AirtableSyncSourceFieldChoiceAllTrashAction $syncSourceFieldChoiceAllTrashAction;

    public function __construct()
    {
        $this->syncSourceFieldChoiceReconcileAction = app(AirtableSyncSourceFieldChoiceReconcileAction::class);

        $this->syncSourceFieldChoiceAllTrashAction = app(AirtableSyncSourceFieldChoiceAllTrashAction::class);
    }

    /**
     * @param  Collection<AirtableSyncSourceFieldOptionsChoiceResourceResponseDto>  $syncSourceFieldOptionsChoiceResourceResponseDtos
     * @return Collection<AirtableSyncSourceFieldChoice>
     *
     * @throws Exception
     */
    public function handle(Collection $syncSourceFieldOptionsChoiceResourceResponseDtos, AirtableSyncSourceField $syncSourceField): Collection
    {
        Log::info('executing AirtableSyncSourceFieldOptionsChoiceAllReconcileAction');

        $syncSourceFieldOptionsChoiceResourceResponseDtos
            ->each(function (AirtableSyncSourceFieldOptionsChoiceResourceResponseDto $syncSourceFieldOptionsChoiceResourceResponseDto, int $key) {
                $syncSourceFieldOptionsChoiceResourceResponseDto->rank = $key + 1;
            });

        $syncSourceFieldChoices = $syncSourceFieldOptionsChoiceResourceResponseDtos
            ->map(function (AirtableSyncSourceFieldOptionsChoiceResourceResponseDto $syncSourceFieldOptionsChoiceResourceResponseDto) use ($syncSourceField) {
                return $this->syncSourceFieldChoiceReconcileAction->handle($syncSourceFieldOptionsChoiceResourceResponseDto, $syncSourceField);
            });

        $trashableSyncSourceFieldChoices = $syncSourceField->choices()
            ->whereNotNull('external_id')
            ->whereNotIn('id', $syncSourceFieldChoices->pluck('id'))
            ->get();
        $this->syncSourceFieldChoiceAllTrashAction->handle($trashableSyncSourceFieldChoices);

        return $syncSourceFieldChoices;
    }
}
