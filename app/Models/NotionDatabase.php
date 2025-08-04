<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class NotionDatabase extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'node_id',
        'location_id',
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
