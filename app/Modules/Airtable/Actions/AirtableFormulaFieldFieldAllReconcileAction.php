<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableReferencedFieldIdResourceResponseDto;
use App\Modules\Airtable\Models\AirtableFormulaField;
use App\Modules\Airtable\Models\AirtableSelectionFieldChoice;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class AirtableFormulaFieldFieldAllReconcileAction
{
    protected AirtableFormulaFieldFieldReconcileAction $formulaFieldFieldReconcileAction;

    protected AirtableFormulaFieldFieldAllTrashAction $formulaFieldFieldAllTrashAction;

    public function __construct()
    {
        $this->formulaFieldFieldReconcileAction = app(AirtableFormulaFieldFieldReconcileAction::class);

        $this->formulaFieldFieldAllTrashAction = app(AirtableFormulaFieldFieldAllTrashAction::class);
    }

    /**
     * @param  Collection<AirtableReferencedFieldIdResourceResponseDto>  $referencedFieldIdResourceResponseDtos
     * @return Collection<AirtableSelectionFieldChoice>
     *
     * @throws Exception
     */
    public function handle(Collection $referencedFieldIdResourceResponseDtos, AirtableFormulaField $formulaField): Collection
    {
        Log::info('executing AirtableFormulaFieldFieldAllReconcileAction');

        $formulaFieldFields = $referencedFieldIdResourceResponseDtos
            ->map(function (AirtableReferencedFieldIdResourceResponseDto $referencedFieldIdResourceResponseDto) use ($formulaField) {
                return $this->formulaFieldFieldReconcileAction->handle($referencedFieldIdResourceResponseDto, $formulaField);
            })
            ->filter();

        $trashableFormulaFieldFields = $formulaField->referencedFields()
            ->whereNotIn('id', $formulaFieldFields->pluck('id'))
            ->get();
        $this->formulaFieldFieldAllTrashAction->handle($trashableFormulaFieldFields);

        return $formulaFieldFields;
    }
}
