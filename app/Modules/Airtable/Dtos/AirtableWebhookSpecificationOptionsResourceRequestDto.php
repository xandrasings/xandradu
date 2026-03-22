<?php

namespace App\Modules\Airtable\Dtos;

use Spatie\LaravelData\Data;

class AirtableWebhookSpecificationOptionsResourceRequestDto extends Data
{
    public AirtableWebhookSpecificationOptionsFiltersResourceRequestDto $filters;

    public function __construct() {
        $this->filters = new AirtableWebhookSpecificationOptionsFiltersResourceRequestDto();
    }
}
