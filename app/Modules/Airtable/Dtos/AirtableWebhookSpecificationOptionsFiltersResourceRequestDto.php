<?php

namespace App\Modules\Airtable\Dtos;

use Spatie\LaravelData\Data;

class AirtableWebhookSpecificationOptionsFiltersResourceRequestDto extends Data
{
    public array $dataTypes = [
        'tableMetadata',
        'tableFields',
        'tableData',
        ];
}
