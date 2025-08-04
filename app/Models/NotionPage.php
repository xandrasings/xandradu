<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class NotionPage extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'external_id',
        'node_id',
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
}
