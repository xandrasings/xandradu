<?php

namespace App\Modules\Airtable\Enums;

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

}
