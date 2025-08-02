<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class NotionBot extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'workspace_id',
        'external_id',
        'name',
    ];

    public function workspace(): BelongsTo
    {
        return $this->belongsTo(NotionWorkspace::class, 'workspace_id');
    }
}
