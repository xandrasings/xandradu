<?php

namespace App\Modules\Airtable\Enums;

enum AirtableRatingIconEnum: string
{
    case CHECK = 'check';

    case CHECKBOX = 'xCheckbox';

    case STAR = 'star';

    case HEART = 'heart';

    case THUMBS_UP = 'thumbsUp';

    case FLAG = 'flag';

    case DOT = 'dot';
}
