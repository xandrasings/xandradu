<?php

namespace App\Modules\Notion\Models;

use App\Modules\Band\Models\BandWiki;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class NotionNode extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'parent_id'
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(NotionNode::class, 'parent_id');
    }

    public function workspace(): HasOne
    {
        return $this->hasOne(NotionWorkspace::class, 'node_id');
    }

    public function database(): HasOne
    {
        return $this->hasOne(NotionDatabase::class, 'node_id');
    }

    public function page(): HasOne
    {
        return $this->hasOne(NotionPage::class, 'node_id');
    }

    public function bandWiki(): HasOne
    {
        return $this->hasOne(BandWiki::class);
    }

    public function children(): HasMany
    {
        return $this->hasMany(NotionNode::class, 'parent_id');
    }

    public function childPages(): HasMany
    {
        return $this->hasMany(NotionDatabase::class, 'location_id');
    }

    // TODO childblocks
}
