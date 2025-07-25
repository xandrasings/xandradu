<?php

namespace App\Actions;

use App\Models\EmailAddress;
use Illuminate\Support\Facades\Log;
use Throwable;

class EmailAddressGetAction
{
    public function handle(string $email): ?EmailAddress
    {
        $emailAddresses = EmailAddress::where(['full_value' => $email])->get();

        if (count($emailAddresses) > 1) {
            Log::warning("EmailAddressGetAction failed, found too many EmailAddress records matching value $email.");
            return null;
        }

        if ($emailAddresses->isEmpty()) {
            Log::notice("EmailAddressGetAction Creating EmailAddress $email");
            try {
                return EmailAddress::create([
                    'full_value' => $email
                ]);
            } catch (Throwable $exception) {
                Log::warning("EmailAddressGetAction failed with exception {$exception->getMessage()}");
                return null;
            }
        } else {
            $emailAddress = $emailAddresses->first();

            return $emailAddress;
        }
    }
}
