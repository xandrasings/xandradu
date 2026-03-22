<?php

namespace App\Modules\Airtable\Dtos;

use Spatie\LaravelData\Data;

class AirtableWebhookSpecificationResourceRequestDto extends Data
{
    public AirtableWebhookSpecificationOptionsResourceRequestDto $options;

    public function __construct() {
        $this->options = new AirtableWebhookSpecificationOptionsResourceRequestDto();
    }
}
