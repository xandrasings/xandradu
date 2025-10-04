<?php

namespace App\Modules\Notion\Models;

use App\Modules\Core\Models\StoredFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotionDatabase extends Model
{
    protected $fillable = [
        'node_id',
        'external_id',
        'title',
        'icon_id'
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

    public function icon(): BelongsTo
    {
        return $this->belongsTo(StoredFile::class, 'icon_id');
    }
}
