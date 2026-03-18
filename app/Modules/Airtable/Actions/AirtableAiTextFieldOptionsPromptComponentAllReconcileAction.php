<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableAiTextFieldOptionsPromptComponentResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableAiTextFieldResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableCreatedAtFieldOptionsDateResultResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableCreatedAtFieldOptionsDateTimeResultResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableCreatedAtFieldOptionsResultResourceResponseDto;
use App\Modules\Airtable\Models\AirtableAiTextField;
use App\Modules\Airtable\Models\AirtableAiTextFieldPromptComponent;
use App\Modules\Airtable\Models\AirtableCreatedAtField;
use App\Modules\Airtable\Models\AirtableDateTimeCreatedAtField;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class AirtableAiTextFieldOptionsPromptComponentAllReconcileAction
{
    protected AirtableAiTextFieldOptionsPromptComponentReconcileAction $aiTextFieldOptionsPromptComponentReconcileAction;

    public function __construct()
    {
        $this->aiTextFieldOptionsPromptComponentReconcileAction = app(AirtableAiTextFieldOptionsPromptComponentReconcileAction::class);
    }

    /**
     * @param Collection<AirtableAiTextFieldOptionsPromptComponentResourceResponseDto> $aiTextFieldOptionsPromptComponentResourceResponseDtos
     * @return Collection<AirtableAiTextFieldPromptComponent>
     * @throws Exception
     */
    public function handle(Collection $aiTextFieldOptionsPromptComponentResourceResponseDtos, AirtableAiTextField $aiTextField): Collection
    {
        Log::info('executing AirtableAiTextFieldOptionsPromptComponentAllReconcileAction', ['aiTextFieldOptionsPromptComponentResourceResponseDtos' => $aiTextFieldOptionsPromptComponentResourceResponseDtos, 'aiTextField' => $aiTextField]);

        $aiTextFieldPromptComponents = $aiTextFieldOptionsPromptComponentResourceResponseDtos->map(function (AirtableAiTextFieldOptionsPromptComponentResourceResponseDto $aiTextFieldOptionsPromptComponentResourceResponseDto) use ($aiTextField) {
            return $this->aiTextFieldOptionsPromptComponentReconcileAction->handle($aiTextFieldOptionsPromptComponentResourceResponseDto, $aiTextField);
        });

        $aiTextField->promptComponents()
            ->whereNotIn('id', $aiTextFieldPromptComponents->pluck('id'))
            ->get()
            ->each(function (AirtableAiTextFieldPromptComponent $aiTextFieldPromptComponent) {
                $aiTextFieldPromptComponent->delete();
                Log::notice('deleted AirtableAiTextFieldPromptComponent.', ['aiTextFieldPromptComponent' => $aiTextFieldPromptComponent]);
            });

        return $aiTextFieldPromptComponents;
    }
}
