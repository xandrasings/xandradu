<?php

namespace App\Modules\Airtable\Dtos;

use App\Modules\Airtable\Enums\AirtableFieldResourceTypeEnum;
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
    #[MapOutputName('external_id')]
    public string $id;

    #[WithTransformer(LengthyStringTransformer::class, length: 32)]
    public string $name;

    #[WithTransformer(LengthyStringTransformer::class, length: 256)]
    public ?string $description;

    #[PropertyForMorph]
    #[WithCast(EnumCast::class, type: AirtableFieldResourceTypeEnum::class)]
    public AirtableFieldResourceTypeEnum $type;

    public static function morph(array $properties): ?string
    {
        return match ($properties['type']) {
            AirtableFieldResourceTypeEnum::AI_TEXT => AirtableAiTextFieldResourceResponseDto::class,
            AirtableFieldResourceTypeEnum::ATTACHMENTS => AirtableAttachmentsFieldResourceResponseDto::class,
            AirtableFieldResourceTypeEnum::AUTO_NUMBER => AirtableAutoNumberFieldResourceResponseDto::class,
            AirtableFieldResourceTypeEnum::BARCODE => AirtableBarcodeFieldResourceResponseDto::class,
            AirtableFieldResourceTypeEnum::BUTTON => AirtableButtonFieldResourceResponseDto::class,
            AirtableFieldResourceTypeEnum::CHECKBOX => AirtableCheckboxFieldResourceResponseDto::class,
            AirtableFieldResourceTypeEnum::COLLABORATOR => AirtableCollaboratorFieldResourceResponseDto::class,
            AirtableFieldResourceTypeEnum::COLLABORATORS => AirtableCollaboratorsFieldResourceResponseDto::class,
            AirtableFieldResourceTypeEnum::COUNT => AirtableCountFieldResourceResponseDto::class,
            AirtableFieldResourceTypeEnum::CREATED_AT => AirtableCreatedAtFieldResourceResponseDto::class,
            AirtableFieldResourceTypeEnum::CREATED_BY => AirtableCreatedByFieldResourceResponseDto::class,
            AirtableFieldResourceTypeEnum::CURRENCY => AirtableCurrencyFieldResourceResponseDto::class,
            AirtableFieldResourceTypeEnum::DATE  => AirtableDateFieldResourceResponseDto::class,
            AirtableFieldResourceTypeEnum::DATE_AND_TIME => AirtableDateAndTimeFieldResourceResponseDto::class,
            AirtableFieldResourceTypeEnum::DURATION => AirtableDurationFieldResourceResponseDto::class,
            AirtableFieldResourceTypeEnum::EMAIL_ADDRESS => AirtableEmailAddressFieldResourceResponseDto::class,
            AirtableFieldResourceTypeEnum::FORMULA  => AirtableFormulaFieldResourceResponseDto::class,
            AirtableFieldResourceTypeEnum::LONG_TEXT => AirtableLongTextFieldResourceResponseDto::class,
            AirtableFieldResourceTypeEnum::LOOKUP => AirtableLookupFieldResourceResponseDto::class,
            AirtableFieldResourceTypeEnum::NUMBER => AirtableNumberFieldResourceResponseDto::class,
            AirtableFieldResourceTypeEnum::PERCENTAGE => AirtablePercentageFieldResourceResponseDto::class,
            AirtableFieldResourceTypeEnum::PHONE_NUMBER => AirtablePhoneNumberFieldResourceResponseDto::class,
            AirtableFieldResourceTypeEnum::RATING => AirtableRatingFieldResourceResponseDto::class,
            AirtableFieldResourceTypeEnum::RECORD_LINKS => AirtableRecordLinksFieldResourceResponseDto::class,
            AirtableFieldResourceTypeEnum::RICH_TEXT => AirtableRichTextFieldResourceResponseDto::class,
            AirtableFieldResourceTypeEnum::ROLLUP => AirtableRollupFieldResourceResponseDto::class,
            AirtableFieldResourceTypeEnum::SELECTION => AirtableSelectionFieldResourceResponseDto::class,
            AirtableFieldResourceTypeEnum::SELECTIONS => AirtableSelectionsFieldResourceResponseDto::class,
            AirtableFieldResourceTypeEnum::SHORT_TEXT => AirtableShortTextFieldResourceResponseDto::class,
            AirtableFieldResourceTypeEnum::SYNC_SOURCE => AirtableSyncSourceFieldResourceResponseDto::class,
            AirtableFieldResourceTypeEnum::UPDATED_AT => AirtableUpdatedAtFieldResourceResponseDto::class,
            AirtableFieldResourceTypeEnum::UPDATED_BY  => AirtableUpdatedByFieldResourceResponseDto::class,
            AirtableFieldResourceTypeEnum::URL => AirtableUrlFieldResourceResponseDto::class
        };
    }
}
