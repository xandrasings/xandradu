<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableReferencedFieldIdResourceResponseDto;
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
     * @param  Collection<AirtableReferencedFieldIdResourceResponseDto>  $referencedFieldIdResourceResponseDtos
     * @return Collection<AirtableSelectionFieldChoice>
     *
     * @throws Exception
     */
    public function handle(Collection $referencedFieldIdResourceResponseDtos, AirtableUpdatedAtField $updatedAtField): Collection
    {
        Log::info('executing AirtableUpdatedAtFieldFieldAllReconcileAction');

        $updatedAtFieldFields = $referencedFieldIdResourceResponseDtos
            ->map(function (AirtableReferencedFieldIdResourceResponseDto $referencedFieldIdResourceResponseDto) use ($updatedAtField) {
                return $this->updatedAtFieldFieldReconcileAction->handle($referencedFieldIdResourceResponseDto, $updatedAtField);
            })
            ->filter();

        $trashableUpdatedAtFieldFields = $updatedAtField->referencedFields()
            ->whereNotIn('id', $updatedAtFieldFields->pluck('id'))
            ->get();
        $this->updatedAtFieldFieldAllTrashAction->handle($trashableUpdatedAtFieldFields);

        return $updatedAtFieldFields;
    }
}
