<?php

namespace App\Actions;

use App\Models\EmailAddress;
use App\Models\Person;
use Illuminate\Support\Facades\Log;
use Throwable;

class EmailAddressPersonAssociateAction
{
    public function handle(EmailAddress $emailAddress, Person $person, string $label): bool
    {
        $emailAddresses = $person->emailAddresses()->wherePivot('label', $label)->get();

        if (! $emailAddresses->isEmpty()) {
            Log::warning("EmailAddressPersonAssociateAction found Person $person->first_name $person->last_name has one or more email addresses labeled $label");
            return false;
        }

        try {
            Log::notice("TodoistProjectUserAssociateAction creating TodoistProjectUser $emailAddress->full_value $person->first_name $person->last_name $label");
            $person->emailAddresses()->save($emailAddress, array('label' => $label));
        } catch (Throwable $exception) {
            Log::error("TodoistProjectUserAssociateAction failed with exception {$exception->getMessage()}");
            return false;
        }

        return true;
    }
}
