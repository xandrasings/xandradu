<?php

namespace App\Modules\Airtable\Enums;

enum AirtableTimeFormatNameEnum: string
{
    case TWELVE_HOUR = '12hour';

    case TWENTY_FOUR_HOUR = '24hour';
}
