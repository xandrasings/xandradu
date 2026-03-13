<?php

namespace App\Modules\Airtable\Dtos;

use App\Modules\Airtable\Enums\AirtableFieldResourceTypeEnum;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Attributes\PropertyForMorph;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;
use Spatie\LaravelData\Contracts\PropertyMorphableData;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

abstract class AirtableFieldResourceResponseDto extends Data implements PropertyMorphableData
{
    #[MapOutputName('external_id')]
    public string $id;

    public string $name;

    public string|Optional $description;

    #[PropertyForMorph]
    #[WithCast(EnumCast::class, type: AirtableFieldResourceTypeEnum::class)]
    public AirtableFieldResourceTypeEnum $type;

    public static function morph(array $properties): ?string
    {
        return match ($properties['type']) {
            AirtableFieldResourceTypeEnum::ATTACHMENTS => AirtableAttachmentsFieldResourceResponseDto::class,
            AirtableFieldResourceTypeEnum::BARCODE => AirtableBarcodeFieldResourceResponseDto::class,
            AirtableFieldResourceTypeEnum::CHECKBOX => AirtableCheckboxFieldResourceResponseDto::class,
            AirtableFieldResourceTypeEnum::LONG_TEXT => AirtableLongTextFieldResourceResponseDto::class,
            AirtableFieldResourceTypeEnum::SHORT_TEXT => AirtableShortTextFieldResourceResponseDto::class,
            AirtableFieldResourceTypeEnum::AI_TEXT,
            AirtableFieldResourceTypeEnum::AUTO_NUMBER,
            AirtableFieldResourceTypeEnum::BUTTON,
            AirtableFieldResourceTypeEnum::COLLABORATOR,
            AirtableFieldResourceTypeEnum::COLLABORATORS,
            AirtableFieldResourceTypeEnum::COUNT,
            AirtableFieldResourceTypeEnum::CREATED_AT,
            AirtableFieldResourceTypeEnum::CREATED_BY,
            AirtableFieldResourceTypeEnum::CURRENCY,
            AirtableFieldResourceTypeEnum::DATE,
            AirtableFieldResourceTypeEnum::DATE_AND_TIME,
            AirtableFieldResourceTypeEnum::DURATION,
            AirtableFieldResourceTypeEnum::EMAIL_ADDRESS,
            AirtableFieldResourceTypeEnum::FORMULA,
            AirtableFieldResourceTypeEnum::LOOKUP,
            AirtableFieldResourceTypeEnum::NUMBER,
            AirtableFieldResourceTypeEnum::PERCENTAGE,
            AirtableFieldResourceTypeEnum::PHONE_NUMBER,
            AirtableFieldResourceTypeEnum::RATING,
            AirtableFieldResourceTypeEnum::RECORD_LINKS,
            AirtableFieldResourceTypeEnum::RICH_TEXT,
            AirtableFieldResourceTypeEnum::ROLLUP,
            AirtableFieldResourceTypeEnum::SELECTION,
            AirtableFieldResourceTypeEnum::SELECTIONS,
            AirtableFieldResourceTypeEnum::SYNC_SOURCE,
            AirtableFieldResourceTypeEnum::UPDATED_AT,
            AirtableFieldResourceTypeEnum::UPDATED_BY,
            AirtableFieldResourceTypeEnum::URL => AirtableGenericFieldResourceResponseDto::class
        };
    }
}
