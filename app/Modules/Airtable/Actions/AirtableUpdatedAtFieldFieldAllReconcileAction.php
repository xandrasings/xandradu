<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableUpdatedAtFieldOptionsFieldResourceResponseDto;
use App\Modules\Airtable\Models\AirtableSelectionFieldChoice;
use App\Modules\Airtable\Models\AirtableUpdatedAtField;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class AirtableUpdatedAtFieldFieldAllReconcileAction
{
    protected AirtableUpdatedAtFieldFieldReconcileAction $updatedAtFieldFieldReconcileAction;

    protected AirtableUpdatedAtFieldFieldAllTrashAction $updatedAtFieldFieldAllTrashAction;

    public function __construct()
    {
        $this->updatedAtFieldFieldReconcileAction = app(AirtableUpdatedAtFieldFieldReconcileAction::class);

        $this->updatedAtFieldFieldAllTrashAction = app(AirtableUpdatedAtFieldFieldAllTrashAction::class);
    }

    /**
     * @param Collection<AirtableUpdatedAtFieldOptionsFieldResourceResponseDto> $updatedAtFieldOptionsFieldResourceResponseDtos
     * @return Collection<AirtableSelectionFieldChoice>
     * @throws Exception
     */
    public function handle(Collection $updatedAtFieldOptionsFieldResourceResponseDtos, AirtableUpdatedAtField $updatedAtField): Collection
    {
        Log::info('executing AirtableUpdatedAtFieldFieldAllReconcileAction');

        $updatedAtFieldFields = $updatedAtFieldOptionsFieldResourceResponseDtos
            ->map(function (AirtableUpdatedAtFieldOptionsFieldResourceResponseDto $fieldId) use ($updatedAtField) {
                return $this->updatedAtFieldFieldReconcileAction->handle($fieldId, $updatedAtField);
            })
            ->filter();

        $trashableUpdatedAtFieldFields = $updatedAtField->fields()
            ->whereNotIn('id', $updatedAtFieldFields->pluck('id'))
            ->get();
        $this->updatedAtFieldFieldAllTrashAction->handle($trashableUpdatedAtFieldFields);

        return $updatedAtFieldFields;
    }
}
