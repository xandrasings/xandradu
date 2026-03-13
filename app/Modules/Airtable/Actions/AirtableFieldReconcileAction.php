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
    protected AirtableAttachmentsFieldReconcileAction $attachmentsFieldReconcileAction;

    protected AirtableCheckboxFieldReconcileAction $checkboxFieldReconcileAction;

    protected AirtableLongTextFieldReconcileAction $longTextFieldReconcileAction;

    protected AirtableShortTextFieldReconcileAction $shortTextFieldReconcileAction;

    public function __construct()
    {
        $this->attachmentsFieldReconcileAction = app(AirtableAttachmentsFieldReconcileAction::class);

        $this->checkboxFieldReconcileAction = app(AirtableCheckboxFieldReconcileAction::class);

        $this->longTextFieldReconcileAction = app(AirtableLongTextFieldReconcileAction::class);

        $this->shortTextFieldReconcileAction = app(AirtableShortTextFieldReconcileAction::class);
    }

    /**
     * @throws Exception
     */
    public function handle(AirtableFieldResourceResponseDto $fieldResourceResponseDto, AirtableTable $table): AirtableField
    {
        Log::info('executing AirtableFieldReconcileAction', ['fieldResourceResponseDto' => $fieldResourceResponseDto, 'table' => $table]);

        $field = $table->fields()->updateOrCreate(
            $fieldResourceResponseDto->only('id')->toArray(),
            $fieldResourceResponseDto->except('id', 'options')->toArray(),
        );
        Log::notice('created or updated AirtableField', ['field' => $field, 'fieldResourceResponseDto' => $fieldResourceResponseDto]);

        match ($fieldResourceResponseDto->type) {
            AirtableFieldResourceTypeEnum::ATTACHMENTS => $this->attachmentsFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldResourceTypeEnum::CHECKBOX => $this->checkboxFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldResourceTypeEnum::LONG_TEXT => $this->longTextFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldResourceTypeEnum::SHORT_TEXT => $this->shortTextFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldResourceTypeEnum::AI_TEXT,
            AirtableFieldResourceTypeEnum::AUTO_NUMBER,
            AirtableFieldResourceTypeEnum::BARCODE,
            AirtableFieldResourceTypeEnum::BUTTON,
            AirtableFieldResourceTypeEnum::COLLABORATOR,
            AirtableFieldResourceTypeEnum::COLLABORATORS,
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
            AirtableFieldResourceTypeEnum::LOOKUP,
            AirtableFieldResourceTypeEnum::NUMBER,
            AirtableFieldResourceTypeEnum::PHONE,
            AirtableFieldResourceTypeEnum::RATING,
            AirtableFieldResourceTypeEnum::RECORD_LINKS,
            AirtableFieldResourceTypeEnum::RICH_TEXT,
            AirtableFieldResourceTypeEnum::ROLLUP,
            AirtableFieldResourceTypeEnum::SELECTION,
            AirtableFieldResourceTypeEnum::SELECTIONS,
            AirtableFieldResourceTypeEnum::SYNC_SOURCE,
            AirtableFieldResourceTypeEnum::URL => Log::error('Encountered an unsupported Airtable field type.', ['field' => $field, 'fieldResourceResponseDto' => $fieldResourceResponseDto]),
            default => Log::error('Encountered an unrecognized Airtable field type.', ['field' => $field, 'fieldResourceResponseDto' => $fieldResourceResponseDto]),
        };

        return $field;
    }
}
