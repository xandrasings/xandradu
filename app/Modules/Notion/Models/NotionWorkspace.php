<?php

namespace App\Modules\Notion\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NotionWorkspace extends Model
{
    protected $fillable = [
        'node_id',
        'name',
    ];

    public function node(): BelongsTo
    {
        return $this->belongsTo(NotionNode::class, 'node_id');
    }

    public function bots(): HasMany
    {
        return $this->hasMany(NotionBot::class, 'workspace_id');
    }
}
