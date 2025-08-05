<?php

namespace App\Modules\Core\Actions;

use App\Modules\Core\Models\EmailAddress;
use App\Modules\Core\Models\Person;
use Illuminate\Support\Facades\Log;
use Throwable;

class EmailAddressPersonAssociateAction
{
    public function handle(EmailAddress $emailAddress, Person $person, string $label): bool
    {
        if (!$person->emailAddresses()->wherePivot('label', $label)->get()->isEmpty()) {
            Log::warning("EmailAddressPersonAssociateAction found Person $person->id has one or more EmailAddress labeled $label");
            return false;
        }

        try {
            Log::notice("EmailAddressPersonAssociateAction creating EmailAddressPerson with EmailAddress $emailAddress->id, Person $person->id.");
            $person->emailAddresses()->save($emailAddress, array('label' => $label));
        } catch (Throwable $exception) {
            Log::warning("EmailAddressPersonAssociateAction failed with exception {$exception->getMessage()}.");
            return false;
        }

        return true;
    }
}
