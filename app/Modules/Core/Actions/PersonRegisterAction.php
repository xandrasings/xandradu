<?php

namespace App\Modules\Core\Actions;

use App\Modules\Core\Models\Person;
use Illuminate\Support\Facades\Log;

class PersonRegisterAction
{
    public function handle(string $firstName, string $lastName): ?Person
    {
        $people = Person::where([
            'first_name' => $firstName,
            'last_name' => $lastName,
        ])->get();

        if ($people->count() > 1) {
            Log::warning("Multiple people named $firstName $lastName exist.");
            return null;
        }

        if($people->isEmpty()) {
            Log::notice("Creating new person $firstName $lastName.");
            return Person::create([
                'first_name' => $firstName,
                'last_name' => $lastName,
            ]);
        }

        Log::warning("Person $firstName $lastName already exists.");
        return $people->first();
    }
}
