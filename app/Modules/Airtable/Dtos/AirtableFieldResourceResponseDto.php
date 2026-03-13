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
            AirtableFieldResourceTypeEnum::CHECKBOX => AirtableCheckboxFieldResourceResponseDto::class,
            AirtableFieldResourceTypeEnum::MULTIPLE_LINE_TEXT => AirtableMultipleLineFieldResourceResponseDto::class,
            AirtableFieldResourceTypeEnum::SINGLE_LINE_TEXT => AirtableSingleLineFieldResourceResponseDto::class,
            AirtableFieldResourceTypeEnum::AI_TEXT,
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
            AirtableFieldResourceTypeEnum::DURATION,
            AirtableFieldResourceTypeEnum::EMAIL,
            AirtableFieldResourceTypeEnum::FORMULA,
            AirtableFieldResourceTypeEnum::LAST_MODIFIED_BY,
            AirtableFieldResourceTypeEnum::LAST_MODIFIED_TIME,
            AirtableFieldResourceTypeEnum::LINK_TO_ANOTHER_RECORD,
            AirtableFieldResourceTypeEnum::LOOKUP,
            AirtableFieldResourceTypeEnum::MULTIPLE_COLLABORATORS,
            AirtableFieldResourceTypeEnum::MULTIPLE_SELECT,
            AirtableFieldResourceTypeEnum::NUMBER,
            AirtableFieldResourceTypeEnum::PERCENT,
            AirtableFieldResourceTypeEnum::PHONE,
            AirtableFieldResourceTypeEnum::RATING,
            AirtableFieldResourceTypeEnum::RICH_TEXT,
            AirtableFieldResourceTypeEnum::ROLLUP,
            AirtableFieldResourceTypeEnum::SINGLE_SELECT,
            AirtableFieldResourceTypeEnum::SYNC_SOURCE,
            AirtableFieldResourceTypeEnum::URL => AirtableGenericFieldResourceResponseDto::class
        };
    }
}
