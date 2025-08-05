<?php

namespace App\Modules\Core\Actions;

use App\Modules\Core\Models\EmailAddress;
use Illuminate\Support\Facades\Log;
use Throwable;

class EmailAddressInstantiateAction
{
    public function handle(string $fullValue): ?EmailAddress
    {
        try {
            Log::notice("EmailAddressInstantiateAction creating EmailAddress from $fullValue.");
            return EmailAddress::create([
                'full_value' => $fullValue,
            ]);
        } catch (Throwable $exception) {
            Log::warning("BandWikiInstantiateAction failed with exception {$exception->getMessage()}.");
            return null;
        }
    }
}
