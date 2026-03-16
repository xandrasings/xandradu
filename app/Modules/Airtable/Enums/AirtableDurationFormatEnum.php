<?php

namespace App\Modules\Airtable\Enums;

enum AirtableDurationFormatEnum: string
{
    case H_MM = 'h:mm';

    case H_MM_SS = 'h:mm:ss';

    case H_MM_SS_S = 'h:mm:ss.S';

    case H_MM_SS_SS = 'h:mm:ss.SS';

    case H_MM_SS_SSS = 'h:mm:ss.SSS';
}
