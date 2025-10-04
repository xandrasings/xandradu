<?php

namespace App\Modules\Notion\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotionPage extends Model
{
    protected $fillable = [
        'node_id',
        'external_id',
        'title',
    ];

    public function setExternalIdAttribute($value)
    {
        $this->attributes['external_id'] = str_replace('-', '', $value);
    }

    public function node(): BelongsTo
    {
        return $this->belongsTo(NotionNode::class, 'node_id');
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(NotionNode::class, 'location_id');
    }
}
