<?php

namespace App\Actions;

use App\Models\Person;
use Illuminate\Support\Facades\Log;

class PersonSelectAction
{
    public function handle(string $firstName, string $lastName): ?Person
    {
        $people = Person::where([
            'first_name' => $firstName,
            'last_name' => $lastName,
        ])->get();

        if ($people->count() > 1) {
            Log::warning("PersonSelectAction failed because multiple Person records exist with name $firstName $lastName.");
            return null;
        }

        if($people->isEmpty()) {
            Log::warning("PersonSelectAction failed because no Person records exist with name $firstName $lastName.");
            return null;
        }

        return $people->first();
    }
}
