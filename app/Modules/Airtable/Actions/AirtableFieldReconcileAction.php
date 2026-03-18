<?php

namespace App\Modules\Airtable\Actions;

use App\Modules\Airtable\Dtos\AirtableFieldResourceResponseDto;
use App\Modules\Airtable\Enums\AirtableFieldTypeEnum;
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

        $fieldResourceResponseDto->type->validate($fieldResourceResponseDto);
        match ($fieldResourceResponseDto->type) {
            AirtableFieldTypeEnum::AI_TEXT => $this->aiTextFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldTypeEnum::ATTACHMENTS => $this->attachmentsFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldTypeEnum::AUTO_NUMBER => $this->autoNumberFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldTypeEnum::BARCODE => $this->barcodeFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldTypeEnum::BUTTON => $this->buttonFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldTypeEnum::CHECKBOX => $this->checkboxFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldTypeEnum::COLLABORATOR => $this->collaboratorFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldTypeEnum::COLLABORATORS => $this->collaboratorsFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldTypeEnum::COUNT => $this->countFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldTypeEnum::CREATED_AT => $this->createdAtFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldTypeEnum::CREATED_BY => $this->createdByFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldTypeEnum::CURRENCY => $this->currencyFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldTypeEnum::DATE => $this->dateFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldTypeEnum::DATE_AND_TIME => $this->dateAndTimeFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldTypeEnum::DURATION => $this->durationFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldTypeEnum::EMAIL_ADDRESS => $this->emailAddressFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldTypeEnum::FORMULA => $this->formulaFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldTypeEnum::LONG_TEXT => $this->longTextFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldTypeEnum::LOOKUP => $this->lookupFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldTypeEnum::NUMBER => $this->numberFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldTypeEnum::PERCENTAGE => $this->percentageFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldTypeEnum::PHONE_NUMBER => $this->phoneNumberFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldTypeEnum::RATING => $this->ratingFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldTypeEnum::RECORD_LINKS => $this->recordLinksFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldTypeEnum::RICH_TEXT => $this->richTextFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldTypeEnum::ROLLUP => $this->rollupFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldTypeEnum::SELECTION => $this->selectionFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldTypeEnum::SELECTIONS => $this->selectionsFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldTypeEnum::SHORT_TEXT => $this->shortTextFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldTypeEnum::SYNC_SOURCE => $this->syncSourceFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldTypeEnum::UPDATED_AT => $this->updatedAtFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldTypeEnum::UPDATED_BY => $this->updatedByFieldReconcileAction->handle($fieldResourceResponseDto, $field),
            AirtableFieldTypeEnum::URL => $this->urlFieldReconcileAction->handle($fieldResourceResponseDto, $field),
        };

        return $field;
    }
}
