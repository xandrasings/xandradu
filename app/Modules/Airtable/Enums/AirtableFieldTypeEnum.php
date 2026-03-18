<?php

namespace App\Modules\Airtable\Enums;

use App\Modules\Airtable\Dtos\AirtableAiTextFieldResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableAttachmentsFieldResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableAutoNumberFieldResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableBarcodeFieldResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableButtonFieldResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableCheckboxFieldResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableCollaboratorFieldResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableCollaboratorsFieldResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableCountFieldResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableCreatedAtFieldResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableCreatedByFieldResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableCurrencyFieldResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableDateAndTimeFieldResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableDateFieldResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableDurationFieldResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableEmailAddressFieldResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableFieldResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableFormulaFieldResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableLongTextFieldResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableLookupFieldResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableNumberFieldResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtablePercentageFieldResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtablePhoneNumberFieldResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableRatingFieldResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableRecordLinksFieldResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableRichTextFieldResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableRollupFieldResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableSelectionFieldResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableSelectionsFieldResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableShortTextFieldResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableSyncSourceFieldResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableUpdatedAtFieldResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableUpdatedByFieldResourceResponseDto;
use App\Modules\Airtable\Dtos\AirtableUrlFieldResourceResponseDto;
use Illuminate\Support\Facades\Log;
use phpDocumentor\Reflection\Exception;

enum AirtableFieldTypeEnum: string {
    case AI_TEXT = 'aiText';

    case ATTACHMENTS = 'multipleAttachments';

    case AUTO_NUMBER = 'autoNumber';

    case BARCODE = 'barcode';

    case BUTTON = 'button';

    case CHECKBOX = 'checkbox';

    case COLLABORATOR = 'singleCollaborator';

    case COLLABORATORS = 'multipleCollaborators';

    case COUNT = 'count';

    case CREATED_AT = 'createdTime';

    case CREATED_BY = 'createdBy';

    case CURRENCY = 'currency';

    case DATE = 'date';

    case DATE_AND_TIME = 'dateTime';

    case DURATION = 'duration';

    case EMAIL_ADDRESS = 'email';

    case FORMULA = 'formula';

    case LONG_TEXT = 'multilineText';

    case LOOKUP = 'multipleLookupValues';

    case NUMBER = 'number';

    case PERCENTAGE = 'percent';

    case PHONE_NUMBER = 'phoneNumber';

    case RATING = 'rating';

    case RECORD_LINKS = 'multipleRecordLinks';

    case RICH_TEXT = 'richText';

    case ROLLUP = 'rollup';

    case SELECTION = 'singleSelect';

    case SELECTIONS = 'multipleSelects';

    case SHORT_TEXT = 'singleLineText';

    case SYNC_SOURCE = 'externalSyncSource';

    case UPDATED_AT = 'lastModifiedTime';

    case UPDATED_BY = 'lastModifiedBy';

    case URL = 'url';

    /**
     * @throws Exception
     */
    public function validate(AirtableFieldResourceResponseDto $fieldResourceResponseDto): void
    {
        $isValid = match($this) {
            self::AI_TEXT => $fieldResourceResponseDto instanceof AirtableAiTextFieldResourceResponseDto,
            self::ATTACHMENTS => $fieldResourceResponseDto instanceof AirtableAttachmentsFieldResourceResponseDto,
            self::AUTO_NUMBER => $fieldResourceResponseDto instanceof AirtableAutoNumberFieldResourceResponseDto,
            self::BARCODE => $fieldResourceResponseDto instanceof AirtableBarcodeFieldResourceResponseDto,
            self::BUTTON => $fieldResourceResponseDto instanceof AirtableButtonFieldResourceResponseDto,
            self::CHECKBOX => $fieldResourceResponseDto instanceof AirtableCheckboxFieldResourceResponseDto,
            self::COLLABORATOR => $fieldResourceResponseDto instanceof AirtableCollaboratorFieldResourceResponseDto,
            self::COLLABORATORS => $fieldResourceResponseDto instanceof AirtableCollaboratorsFieldResourceResponseDto,
            self::COUNT => $fieldResourceResponseDto instanceof AirtableCountFieldResourceResponseDto,
            self::CREATED_AT => $fieldResourceResponseDto instanceof AirtableCreatedAtFieldResourceResponseDto,
            self::CREATED_BY => $fieldResourceResponseDto instanceof AirtableCreatedByFieldResourceResponseDto,
            self::CURRENCY => $fieldResourceResponseDto instanceof AirtableCurrencyFieldResourceResponseDto,
            self::DATE => $fieldResourceResponseDto instanceof AirtableDateFieldResourceResponseDto,
            self::DATE_AND_TIME => $fieldResourceResponseDto instanceof AirtableDateAndTimeFieldResourceResponseDto,
            self::DURATION => $fieldResourceResponseDto instanceof AirtableDurationFieldResourceResponseDto,
            self::EMAIL_ADDRESS => $fieldResourceResponseDto instanceof AirtableEmailAddressFieldResourceResponseDto,
            self::FORMULA => $fieldResourceResponseDto instanceof AirtableFormulaFieldResourceResponseDto,
            self::LONG_TEXT => $fieldResourceResponseDto instanceof AirtableLongTextFieldResourceResponseDto,
            self::LOOKUP => $fieldResourceResponseDto instanceof AirtableLookupFieldResourceResponseDto,
            self::NUMBER => $fieldResourceResponseDto instanceof AirtableNumberFieldResourceResponseDto,
            self::PERCENTAGE => $fieldResourceResponseDto instanceof AirtablePercentageFieldResourceResponseDto,
            self::PHONE_NUMBER => $fieldResourceResponseDto instanceof AirtablePhoneNumberFieldResourceResponseDto,
            self::RATING => $fieldResourceResponseDto instanceof AirtableRatingFieldResourceResponseDto,
            self::RECORD_LINKS => $fieldResourceResponseDto instanceof AirtableRecordLinksFieldResourceResponseDto,
            self::RICH_TEXT => $fieldResourceResponseDto instanceof AirtableRichTextFieldResourceResponseDto,
            self::ROLLUP => $fieldResourceResponseDto instanceof AirtableRollupFieldResourceResponseDto,
            self::SELECTION => $fieldResourceResponseDto instanceof AirtableSelectionFieldResourceResponseDto,
            self::SELECTIONS => $fieldResourceResponseDto instanceof AirtableSelectionsFieldResourceResponseDto,
            self::SHORT_TEXT => $fieldResourceResponseDto instanceof AirtableShortTextFieldResourceResponseDto,
            self::SYNC_SOURCE => $fieldResourceResponseDto instanceof AirtableSyncSourceFieldResourceResponseDto,
            self::UPDATED_AT => $fieldResourceResponseDto instanceof AirtableUpdatedAtFieldResourceResponseDto,
            self::UPDATED_BY => $fieldResourceResponseDto instanceof AirtableUpdatedByFieldResourceResponseDto,
            self::URL => $fieldResourceResponseDto instanceof AirtableUrlFieldResourceResponseDto,
        };

        if (!$isValid) {
            Log::error("AirtableFieldResourceResponseDto type did not match subclass.", ['fieldResourceResponseDto' => $fieldResourceResponseDto, 'type' => $this]);
            throw new Exception("AirtableFieldResourceResponseDto type did not match subclass.");
        }
    }
}
