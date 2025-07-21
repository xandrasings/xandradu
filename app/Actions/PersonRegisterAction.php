<?php

namespace App\Actions;

use App\Models\Person;
use Illuminate\Support\Facades\Log;

class PersonRegisterAction
{
    public function handle(string $firstName, string $lastName): void
    {
        $person = Person::firstOrCreate([
            'first_name' => $firstName,
            'last_name' => $lastName,
        ]);

        Log::notice("$firstName $lastName is person $person->id");
    }
}
