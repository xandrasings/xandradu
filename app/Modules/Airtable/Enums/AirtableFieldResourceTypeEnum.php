<?php

namespace App\Modules\Airtable\Enums;

enum AirtableFieldResourceTypeEnum: string {
    case AI_TEXT = 'aiText';

    case ATTACHMENTS = 'multipleAttachments';

    case AUTO_NUMBER = 'autoNumber';

    case BARCODE = 'barcode';

    case BUTTON = 'button';

    case CHECKBOX = 'checkbox';

    case COLLABORATOR = 'singleCollaborator';

    case COLLABORATORS = 'multipleCollaborators';

    case COUNT = 'count';

    case CREATED_BY = 'createdBy';

    case CREATED_TIME = 'createdTime';

    case CURRENCY = 'currency';

    case DATE = 'date';

    case DATE_AND_TIME = 'dateTime';

    case DURATION = 'duration';

    case EMAIL = 'email';

    case FORMULA = 'formula';

    case LAST_MODIFIED_BY = 'lastModifiedBy';

    case LAST_MODIFIED_TIME = 'lastModifiedTime';

    case LONG_TEXT = 'multilineText';

    case LOOKUP = 'multipleLookupValues';

    case NUMBER = 'number';

    case PERCENT = 'percent';

    case PHONE = 'phoneNumber';

    case RATING = 'rating';

    case RECORD_LINKS = 'multipleRecordLinks';

    case RICH_TEXT = 'richText';

    case ROLLUP = 'rollup';

    case SELECTION = 'singleSelect';

    case SELECTIONS = 'multipleSelects';

    case SHORT_TEXT = 'singleLineText';

    case SYNC_SOURCE = 'externalSyncSource';

    case URL = 'url';

}
