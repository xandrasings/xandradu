<?php

namespace App\Modules\Notion\Actions;

use App\Models\NotionPage;

class NotionPageExistsAction
{
    public function handle(string $id): bool
    {
        return NotionPage::where([
            'external_id' => $id
        ])->withTrashed()->get()->count() > 0;
    }
}
