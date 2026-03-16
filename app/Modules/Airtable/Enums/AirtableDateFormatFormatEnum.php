<?php

namespace App\Modules\Airtable\Enums;

enum AirtableDateFormatFormatEnum: string
{
    case LOCAL = 'l';

    case FRIENDLY = 'LL';

    case US = 'M/D/YYYY';

    case EUROPEAN = 'D/M/YYYY';

    case ISO = 'YYYY-MM-DD';

}
