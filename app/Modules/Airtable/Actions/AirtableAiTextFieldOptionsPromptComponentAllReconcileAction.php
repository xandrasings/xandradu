<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableAiTextFieldOptionsPromptComponentResourceResponseDto;
use App\Modules\Airtable\Models\AirtableAiTextField;
use App\Modules\Airtable\Models\AirtableAiTextFieldPromptComponent;
use App\Modules\Airtable\Models\AirtableTable;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class AirtableAiTextFieldOptionsPromptComponentAllReconcileAction
{
    protected AirtableAiTextFieldOptionsPromptComponentReconcileAction $aiTextFieldOptionsPromptComponentReconcileAction;

    protected AirtableAiTextFieldPromptComponentAllTrashAction $aiTextFieldPromptComponentAllTrashAction;

    public function __construct()
    {
        $this->aiTextFieldOptionsPromptComponentReconcileAction = app(AirtableAiTextFieldOptionsPromptComponentReconcileAction::class);

        $this->aiTextFieldPromptComponentAllTrashAction = app(AirtableAiTextFieldPromptComponentAllTrashAction::class);
    }

    /**
     * @param Collection<AirtableAiTextFieldOptionsPromptComponentResourceResponseDto> $aiTextFieldOptionsPromptComponentResourceResponseDtos
     * @return Collection<AirtableAiTextFieldPromptComponent>
     * @throws Exception
     */
    public function handle(Collection $aiTextFieldOptionsPromptComponentResourceResponseDtos, AirtableAiTextField $aiTextField): Collection
    {
        Log::info('executing AirtableAiTextFieldOptionsPromptComponentAllReconcileAction', ['aiTextFieldOptionsPromptComponentResourceResponseDtos' => $aiTextFieldOptionsPromptComponentResourceResponseDtos, 'aiTextField' => $aiTextField]);

        $aiTextFieldOptionsPromptComponentResourceResponseDtos->each(function (AirtableAiTextFieldOptionsPromptComponentResourceResponseDto $aiTextFieldOptionsPromptComponentResourceResponseDto, int $key) {
            $aiTextFieldOptionsPromptComponentResourceResponseDto->rank = $key + 1;
        });

        $aiTextFieldPromptComponents = $aiTextFieldOptionsPromptComponentResourceResponseDtos->map(function (AirtableAiTextFieldOptionsPromptComponentResourceResponseDto $aiTextFieldOptionsPromptComponentResourceResponseDto) use ($aiTextField) {
            return $this->aiTextFieldOptionsPromptComponentReconcileAction->handle($aiTextFieldOptionsPromptComponentResourceResponseDto, $aiTextField);
        });

        $trashableAiTextFieldPromptComponents =$aiTextField->promptComponents()
            ->whereNotIn('id', $aiTextFieldPromptComponents->pluck('id'))
            ->get();
        $this->aiTextFieldPromptComponentAllTrashAction->handle($trashableAiTextFieldPromptComponents);

        return $aiTextFieldPromptComponents;
    }
}
