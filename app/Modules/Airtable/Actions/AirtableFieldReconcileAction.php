<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableFieldResourceResponseDto;
use App\Modules\Airtable\Enums\AirtableFieldResourceTypeEnum;
use App\Modules\Airtable\Models\AirtableField;
use App\Modules\Airtable\Models\AirtableTable;
use Exception;
use Illuminate\Support\Facades\Log;

class AirtableFieldReconcileAction
{
    protected AirtableCheckboxFieldReconcileAction $checkboxFieldReconcileAction;

    public function __construct()
    {
        $this->checkboxFieldReconcileAction = app(AirtableCheckboxFieldReconcileAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(AirtableFieldResourceResponseDto $fieldResourceResponseDto, AirtableTable $table): AirtableField
    {
        Log::info('executing AirtableFieldReconcileAction', ['fieldResourceResponseDto' => $fieldResourceResponseDto, 'table' => $table]);

        $field = $table->fields()->updateOrCreate(
            $fieldResourceResponseDto->only('id')->toArray(),
            $fieldResourceResponseDto->except('id')->toArray(),
        );
        Log::notice('created or updated AirtableField', ['field' => $field, 'fieldResourceResponseDto' => $fieldResourceResponseDto]);

        match ($fieldResourceResponseDto->type) {
            AirtableFieldResourceTypeEnum::CHECKBOX => $this->checkboxFieldReconcileAction->handle($fieldResourceResponseDto->options, $field),
            AirtableFieldResourceTypeEnum::AI_TEXT,
            AirtableFieldResourceTypeEnum::ATTACHMENT,
            AirtableFieldResourceTypeEnum::AUTO_NUMBER,
            AirtableFieldResourceTypeEnum::BARCODE,
            AirtableFieldResourceTypeEnum::BUTTON,
            AirtableFieldResourceTypeEnum::COLLABORATOR,
            AirtableFieldResourceTypeEnum::COUNT,
            AirtableFieldResourceTypeEnum::CREATED_BY,
            AirtableFieldResourceTypeEnum::CREATED_TIME,
            AirtableFieldResourceTypeEnum::CURRENCY,
            AirtableFieldResourceTypeEnum::DATE,
            AirtableFieldResourceTypeEnum::DATE_AND_TIME,
            AirtableFieldResourceTypeEnum::EMAIL,
            AirtableFieldResourceTypeEnum::FORMULA,
            AirtableFieldResourceTypeEnum::LAST_MODIFIED_BY,
            AirtableFieldResourceTypeEnum::LAST_MODIFIED_TIME,
            AirtableFieldResourceTypeEnum::LINK_TO_ANOTHER_RECORD,
            AirtableFieldResourceTypeEnum::LONG_TEXT,
            AirtableFieldResourceTypeEnum::LOOKUP,
            AirtableFieldResourceTypeEnum::MULTIPLE_COLLABORATORS,
            AirtableFieldResourceTypeEnum::MULTIPLE_SELECT,
            AirtableFieldResourceTypeEnum::NUMBER,
            AirtableFieldResourceTypeEnum::PHONE,
            AirtableFieldResourceTypeEnum::RATING,
            AirtableFieldResourceTypeEnum::RICH_TEXT,
            AirtableFieldResourceTypeEnum::ROLLUP,
            AirtableFieldResourceTypeEnum::SINGLE_LINE_TEXT,
            AirtableFieldResourceTypeEnum::SINGLE_SELECT,
            AirtableFieldResourceTypeEnum::SYNC_SOURCE,
            AirtableFieldResourceTypeEnum::URL => Log::error('Encountered an unsupported Airtable field type.', ['field' => $field, 'fieldResourceResponseDto' => $fieldResourceResponseDto]),
            default => Log::error('Encountered an unrecognized Airtable field type.', ['field' => $field, 'fieldResourceResponseDto' => $fieldResourceResponseDto]),
        };

        return $field;
    }
}
