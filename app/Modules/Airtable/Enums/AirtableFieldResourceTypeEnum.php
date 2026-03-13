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

    case LINK_TO_ANOTHER_RECORD = 'multipleRecordLinks';

    case LOOKUP = 'multipleLookupValues';

    case MULTIPLE_COLLABORATORS = 'multipleCollaborators';

    case MULTIPLE_LINE_TEXT = 'multilineText';

    case MULTIPLE_SELECT = 'multipleSelects';

    case NUMBER = 'number';

    case PERCENT = 'percent';

    case PHONE = 'phoneNumber';

    case RATING = 'rating';

    case RICH_TEXT = 'richText';

    case ROLLUP = 'rollup';

    case SINGLE_LINE_TEXT = 'singleLineText';

    case SINGLE_SELECT = 'singleSelect';

    case SYNC_SOURCE = 'externalSyncSource';

    case URL = 'url';

}
