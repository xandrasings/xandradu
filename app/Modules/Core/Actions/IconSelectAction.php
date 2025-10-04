<?php

namespace App\Modules\Core\Actions;

use App\Modules\Core\Models\StoredFile;
use Exception;
use Illuminate\Support\Facades\Log;

class IconSelectAction
{
    /**
     * @throws Exception
     */
    public function handle(string $name): StoredFile
    {
        $icons = StoredFile::where([
            'type' => 'icon',
            'name' => $name
        ])->get();

        if ($icons->count() > 1) {
            Log::warning("IconSelectAction failed because multiple StoredFiles with type icon and name {$name} exist.");
            throw new Exception("IconSelectAction failed because multiple StoredFiles with type icon and name {$name} exist.");
        }

        if ($icons->isEmpty()) {
            Log::warning("IconSelectAction failed because no StoredFiles with type icon and name {$name} exist.");
            throw new Exception("IconSelectAction failed because no StoredFiles with type icon and name {$name} exist.");
        }

        return $icons->first();
    }
}
