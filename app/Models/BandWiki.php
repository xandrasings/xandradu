<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BandWiki extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'band_id',
        'notion_node_id',
    ];

    public function band(): BelongsTo
    {
        return $this->belongsTo(Band::class);
    }

    public function rootNode(): BelongsTo
    {
        return $this->belongsTo(NotionNode::class);
    }
}
