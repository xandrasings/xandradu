<?php

namespace App\Modules\Airtable\Enums;

enum AirtableTimeFormatFormatEnum: string
{
    case TWELVE_HOUR = 'h:mma';

    case TWENTY_FOUR_HOUR = 'HH:mm';
}
