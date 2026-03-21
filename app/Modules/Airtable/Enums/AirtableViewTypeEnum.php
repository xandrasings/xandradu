<?php

namespace App\Modules\Airtable\Enums;

enum AirtableViewTypeEnum: string
{
    case GRID = 'grid';

    case FORM = 'form';

    case CALENDAR = 'calendar';

    case GALLERY = 'gallery';

    case KANBAN = 'kanban';

    case TIMELINE = 'timeline';

    case BLOCK = 'block';
}
