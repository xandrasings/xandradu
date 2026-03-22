<?php

namespace App\Modules\Airtable\Dtos;

use Spatie\LaravelData\Data;

class AirtableWebhookCreateRequestDto extends Data
{
    public string $notificationUrl;

    public AirtableWebhookSpecificationResourceRequestDto $specification;

    public function __construct() {
        $this->notificationUrl = config('services.airtable.workspace_id');
        $this->specification = new AirtableWebhookSpecificationResourceRequestDto();
    }
}
