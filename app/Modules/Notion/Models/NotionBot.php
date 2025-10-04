<?php

namespace App\Modules\Notion\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotionBot extends Model
{
    protected $fillable = [
        'workspace_id',
        'external_id',
        'name',
        'label',
        'token'
    ];

    public function workspace(): BelongsTo
    {
        return $this->belongsTo(NotionWorkspace::class, 'workspace_id');
    }
}
