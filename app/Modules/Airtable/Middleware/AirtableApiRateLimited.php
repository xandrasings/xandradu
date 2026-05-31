<?php

namespace App\Modules\Airtable\Middleware;

use Spatie\RateLimitedMiddleware\RateLimited;

class AirtableApiRateLimited extends RateLimited
{
    public function __construct(int $attempts)
    {
        parent::__construct(false);

        $this->allow(3)
            ->everySecond()
            ->key('airtable-api-call')
            ->releaseAfterBackoff($attempts);
    }
}
