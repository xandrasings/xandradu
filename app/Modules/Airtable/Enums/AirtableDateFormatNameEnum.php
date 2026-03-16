<?php

namespace App\Modules\Airtable\Enums;

enum AirtableDateFormatNameEnum: string
{
    case LOCAL = 'local';

    case FRIENDLY = 'friendly';

    case US = 'us';

    case EUROPEAN = 'european';

    case ISO = 'iso';

}
