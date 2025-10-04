<?php

namespace Database\Seeders;

use App\Modules\Core\Models\StoredFile;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        StoredFile::updateOrCreate([
            'type' => 'icon',
            'name' => 'instruments',
        ],[
            'path' => '/icons/instruments.svg'
        ]);

        StoredFile::updateOrCreate([
            'type' => 'icon',
            'name' => 'people',
        ],[
            'path' => '/icons/people.svg'
        ]);
    }
}
