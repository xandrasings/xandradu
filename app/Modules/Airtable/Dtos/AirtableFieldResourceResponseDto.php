<?php

namespace App\Modules\Airtable\Dtos;

use App\Modules\Airtable\Enums\AirtableFieldTypeEnum;
use App\Transformers\LengthyStringTransformer;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Attributes\PropertyForMorph;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Contracts\PropertyMorphableData;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
abstract class AirtableFieldResourceResponseDto extends Data implements PropertyMorphableData
{
    public int $rank = 0;

    #[MapOutputName('external_id')]
    public string $id;

    #[WithTransformer(LengthyStringTransformer::class, length: 32)]
    public string $name;

    #[WithTransformer(LengthyStringTransformer::class, length: 256)]
    public ?string $description;

    #[PropertyForMorph]
    #[WithCast(EnumCast::class, type: AirtableFieldTypeEnum::class)]
    public AirtableFieldTypeEnum $type;

    public static function morph(array $properties): ?string
    {
        return match ($properties['type']) {
            AirtableFieldTypeEnum::AI_TEXT => AirtableAiTextFieldResourceResponseDto::class,
            AirtableFieldTypeEnum::ATTACHMENTS => AirtableAttachmentsFieldResourceResponseDto::class,
            AirtableFieldTypeEnum::AUTO_NUMBER => AirtableAutoNumberFieldResourceResponseDto::class,
            AirtableFieldTypeEnum::BARCODE => AirtableBarcodeFieldResourceResponseDto::class,
            AirtableFieldTypeEnum::BUTTON => AirtableButtonFieldResourceResponseDto::class,
            AirtableFieldTypeEnum::CHECKBOX => AirtableCheckboxFieldResourceResponseDto::class,
            AirtableFieldTypeEnum::COLLABORATOR => AirtableCollaboratorFieldResourceResponseDto::class,
            AirtableFieldTypeEnum::COLLABORATORS => AirtableCollaboratorsFieldResourceResponseDto::class,
            AirtableFieldTypeEnum::COUNT => AirtableCountFieldResourceResponseDto::class,
            AirtableFieldTypeEnum::CREATED_AT => AirtableCreatedAtFieldResourceResponseDto::class,
            AirtableFieldTypeEnum::CREATED_BY => AirtableCreatedByFieldResourceResponseDto::class,
            AirtableFieldTypeEnum::CURRENCY => AirtableCurrencyFieldResourceResponseDto::class,
            AirtableFieldTypeEnum::DATE => AirtableDateFieldResourceResponseDto::class,
            AirtableFieldTypeEnum::DATE_AND_TIME => AirtableDateAndTimeFieldResourceResponseDto::class,
            AirtableFieldTypeEnum::DURATION => AirtableDurationFieldResourceResponseDto::class,
            AirtableFieldTypeEnum::EMAIL_ADDRESS => AirtableEmailAddressFieldResourceResponseDto::class,
            AirtableFieldTypeEnum::FORMULA => AirtableFormulaFieldResourceResponseDto::class,
            AirtableFieldTypeEnum::LONG_TEXT => AirtableLongTextFieldResourceResponseDto::class,
            AirtableFieldTypeEnum::LOOKUP => AirtableLookupFieldResourceResponseDto::class,
            AirtableFieldTypeEnum::NUMBER => AirtableNumberFieldResourceResponseDto::class,
            AirtableFieldTypeEnum::PERCENTAGE => AirtablePercentageFieldResourceResponseDto::class,
            AirtableFieldTypeEnum::PHONE_NUMBER => AirtablePhoneNumberFieldResourceResponseDto::class,
            AirtableFieldTypeEnum::RATING => AirtableRatingFieldResourceResponseDto::class,
            AirtableFieldTypeEnum::RECORD_LINKS => AirtableRecordLinksFieldResourceResponseDto::class,
            AirtableFieldTypeEnum::RICH_TEXT => AirtableRichTextFieldResourceResponseDto::class,
            AirtableFieldTypeEnum::ROLLUP => AirtableRollupFieldResourceResponseDto::class,
            AirtableFieldTypeEnum::SELECTION => AirtableSelectionFieldResourceResponseDto::class,
            AirtableFieldTypeEnum::SELECTIONS => AirtableSelectionsFieldResourceResponseDto::class,
            AirtableFieldTypeEnum::SHORT_TEXT => AirtableShortTextFieldResourceResponseDto::class,
            AirtableFieldTypeEnum::SYNC_SOURCE => AirtableSyncSourceFieldResourceResponseDto::class,
            AirtableFieldTypeEnum::UPDATED_AT => AirtableUpdatedAtFieldResourceResponseDto::class,
            AirtableFieldTypeEnum::UPDATED_BY => AirtableUpdatedByFieldResourceResponseDto::class,
            AirtableFieldTypeEnum::URL => AirtableUrlFieldResourceResponseDto::class
        };
    }
}
