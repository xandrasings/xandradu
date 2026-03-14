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
    protected AirtableAiTextFieldReconcileAction $aiTextFieldReconcileAction;

    protected AirtableAttachmentsFieldReconcileAction $attachmentsFieldReconcileAction;

    protected AirtableAutoNumberFieldReconcileAction $autoNumberFieldReconcileAction;

    protected AirtableBarcodeFieldReconcileAction $barcodeFieldReconcileAction;

    protected AirtableButtonFieldReconcileAction $buttonFieldReconcileAction;

    protected AirtableCheckboxFieldReconcileAction $checkboxFieldReconcileAction;

    protected AirtableCollaboratorFieldReconcileAction $collaboratorFieldReconcileAction;

    protected AirtableCollaboratorsFieldReconcileAction $collaboratorsFieldReconcileAction;

    protected AirtableCountFieldReconcileAction $countFieldReconcileAction;

    protected AirtableCreatedAtFieldReconcileAction $createdAtFieldReconcileAction;

    protected AirtableCreatedByFieldReconcileAction $createdByFieldReconcileAction;

    protected AirtableCurrencyFieldReconcileAction $currencyFieldReconcileAction;

    protected AirtableDateFieldReconcileAction $dateFieldReconcileAction;

    protected AirtableDateAndTimeFieldReconcileAction $dateAndTimeFieldReconcileAction;

    protected AirtableDurationFieldReconcileAction $durationFieldReconcileAction;

    protected AirtableEmailAddressFieldReconcileAction $emailAddressFieldReconcileAction;

    protected AirtableFormulaFieldReconcileAction $formulaFieldReconcileAction;

    protected AirtableLongTextFieldReconcileAction $longTextFieldReconcileAction;

    protected AirtableLookupFieldReconcileAction $lookupFieldReconcileAction;

    protected AirtableNumberFieldReconcileAction $numberFieldReconcileAction;

    protected AirtablePercentageFieldReconcileAction $percentageFieldReconcileAction;

    protected AirtablePhoneNumberFieldReconcileAction $phoneNumberFieldReconcileAction;

    protected AirtableRatingFieldReconcileAction $ratingFieldReconcileAction;

    protected AirtableRecordLinksFieldReconcileAction $recordLinksFieldReconcileAction;

    protected AirtableRichTextFieldReconcileAction $richTextFieldReconcileAction;

    protected AirtableRollupFieldReconcileAction $rollupFieldReconcileAction;

    protected AirtableSelectionFieldReconcileAction $selectionFieldReconcileAction;

    protected AirtableSelectionsFieldReconcileAction $selectionsFieldReconcileAction;

    protected AirtableShortTextFieldReconcileAction $shortTextFieldReconcileAction;

    protected AirtableSyncSourceFieldReconcileAction $syncSourceFieldReconcileAction;

    protected AirtableUpdatedAtFieldReconcileAction $updatedAtFieldReconcileAction;

    protected AirtableUpdatedByFieldReconcileAction $updatedByFieldReconcileAction;

    protected AirtableUrlFieldReconcileAction $urlFieldReconcileAction;

    public function __construct()
    {
        $this->aiTextFieldReconcileAction = app(AirtableAiTextFieldReconcileAction::class);

        $this->attachmentsFieldReconcileAction = app(AirtableAttachmentsFieldReconcileAction::class);

        $this->autoNumberFieldReconcileAction = app(AirtableAutoNumberFieldReconcileAction::class);

        $this->barcodeFieldReconcileAction = app(AirtableBarcodeFieldReconcileAction::class);

        $this->buttonFieldReconcileAction = app(AirtableButtonFieldReconcileAction::class);

        $this->checkboxFieldReconcileAction = app(AirtableCheckboxFieldReconcileAction::class);

        $this->collaboratorFieldReconcileAction = app(AirtableCollaboratorFieldReconcileAction::class);

        $this->collaboratorsFieldReconcileAction = app(AirtableCollaboratorsFieldReconcileAction::class);

        $this->countFieldReconcileAction = app(AirtableCountFieldReconcileAction::class);

        $this->createdAtFieldReconcileAction = app(AirtableCreatedAtFieldReconcileAction::class);

        $this->createdByFieldReconcileAction = app(AirtableCreatedByFieldReconcileAction::class);

        $this->currencyFieldReconcileAction = app(AirtableCurrencyFieldReconcileAction::class);

        $this->dateFieldReconcileAction = app(AirtableDateFieldReconcileAction::class);

        $this->dateAndTimeFieldReconcileAction = app(AirtableDateAndTimeFieldReconcileAction::class);

        $this->durationFieldReconcileAction = app(AirtableDurationFieldReconcileAction::class);

        $this->emailAddressFieldReconcileAction = app(AirtableEmailAddressFieldReconcileAction::class);

        $this->formulaFieldReconcileAction = app(AirtableFormulaFieldReconcileAction::class);

        $this->longTextFieldReconcileAction = app(AirtableLongTextFieldReconcileAction::class);

        $this->lookupFieldReconcileAction = app(AirtableLookupFieldReconcileAction::class);

        $this->numberFieldReconcileAction = app(AirtableNumberFieldReconcileAction::class);

        $this->percentageFieldReconcileAction = app(AirtablePercentageFieldReconcileAction::class);

        $this->phoneNumberFieldReconcileAction = app(AirtablePhoneNumberFieldReconcileAction::class);

        $this->ratingFieldReconcileAction = app(AirtableRatingFieldReconcileAction::class);

        $this->recordLinksFieldReconcileAction = app(AirtableRecordLinksFieldReconcileAction::class);

        $this->richTextFieldReconcileAction = app(AirtableRichTextFieldReconcileAction::class);

        $this->rollupFieldReconcileAction = app(AirtableRollupFieldReconcileAction::class);

        $this->selectionFieldReconcileAction = app(AirtableSelectionFieldReconcileAction::class);

        $this->selectionsFieldReconcileAction = app(AirtableSelectionsFieldReconcileAction::class);

        $this->shortTextFieldReconcileAction = app(AirtableShortTextFieldReconcileAction::class);

        $this->syncSourceFieldReconcileAction = app(AirtableSyncSourceFieldReconcileAction::class);

        $this->updatedAtFieldReconcileAction = app(AirtableUpdatedAtFieldReconcileAction::class);

        $this->updatedByFieldReconcileAction = app(AirtableUpdatedByFieldReconcileAction::class);

        $this->urlFieldReconcileAction = app(AirtableUrlFieldReconcileAction::class);
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
            AirtableFieldResourceTypeEnum::AI_TEXT => $this->aiTextFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldResourceTypeEnum::ATTACHMENTS => $this->attachmentsFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldResourceTypeEnum::AUTO_NUMBER => $this->autoNumberFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldResourceTypeEnum::BARCODE => $this->barcodeFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldResourceTypeEnum::BUTTON => $this->buttonFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldResourceTypeEnum::CHECKBOX => $this->checkboxFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldResourceTypeEnum::COLLABORATOR => $this->collaboratorFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldResourceTypeEnum::COLLABORATORS => $this->collaboratorsFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldResourceTypeEnum::COUNT => $this->countFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldResourceTypeEnum::CREATED_AT => $this->createdAtFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldResourceTypeEnum::CREATED_BY => $this->createdByFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldResourceTypeEnum::CURRENCY => $this->currencyFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldResourceTypeEnum::DATE => $this->dateFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldResourceTypeEnum::DATE_AND_TIME => $this->dateAndTimeFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldResourceTypeEnum::EMAIL_ADDRESS => $this->emailAddressFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldResourceTypeEnum::FORMULA => $this->formulaFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldResourceTypeEnum::LONG_TEXT => $this->longTextFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldResourceTypeEnum::LOOKUP => $this->lookupFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldResourceTypeEnum::NUMBER => $this->numberFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldResourceTypeEnum::PERCENTAGE => $this->percentageFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldResourceTypeEnum::PHONE_NUMBER => $this->phoneNumberFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldResourceTypeEnum::RATING => $this->ratingFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldResourceTypeEnum::RECORD_LINKS => $this->recordLinksFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldResourceTypeEnum::RICH_TEXT => $this->richTextFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldResourceTypeEnum::ROLLUP => $this->rollupFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldResourceTypeEnum::SELECTION => $this->selectionFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldResourceTypeEnum::SELECTIONS => $this->selectionsFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldResourceTypeEnum::SHORT_TEXT => $this->shortTextFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldResourceTypeEnum::SYNC_SOURCE => $this->syncSourceFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldResourceTypeEnum::UPDATED_AT => $this->updatedAtFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldResourceTypeEnum::UPDATED_BY => $this->updatedByFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldResourceTypeEnum::URL => $this->urlFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            default => Log::error('Encountered an unrecognized Airtable field type.', ['field' => $field, 'fieldResourceResponseDto' => $fieldResourceResponseDto]),
        };

        return $field;
    }
}
