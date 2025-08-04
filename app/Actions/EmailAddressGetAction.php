<?php

namespace App\Actions;

use App\Models\EmailAddress;
use Illuminate\Support\Facades\Log;

class EmailAddressGetAction
{
    protected EmailAddressInstantiateAction $emailAddressInstantiateAction;

    public function __construct()
    {
        $this->emailAddressInstantiateAction = app(EmailAddressInstantiateAction::class);
    }

    public function handle(string $fullValue): ?EmailAddress
    {
        $emailAddresses = EmailAddress::where([
            'full_value' => $fullValue
        ])->get();

        if (count($emailAddresses) > 1) {
            Log::warning("EmailAddressGetAction failed, found too many EmailAddress records matching value $fullValue.");
            return null;
        }

        if ($emailAddresses->isEmpty()) {
            return $this->emailAddressInstantiateAction->handle($fullValue);
        }

        return $emailAddresses->first();
    }
}
