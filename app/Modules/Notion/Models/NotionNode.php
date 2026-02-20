<?php

namespace App\Modules\Notion\Models;

use App\Modules\Band\Models\BandWiki;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int|null $parent_id
 * @property int $rank
 * @property int $step
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read BandWiki|null $bandWiki
 * @property-read \Illuminate\Database\Eloquent\Collection<int, NotionNode> $children
 * @property-read int|null $children_count
 * @property-read \App\Modules\Notion\Models\NotionDatabase|null $database
 * @property-read \App\Modules\Notion\Models\NotionPage|null $page
 * @property-read NotionNode|null $parent
 * @property-read \App\Modules\Notion\Models\NotionWorkspace|null $workspace
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionNode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionNode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionNode onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionNode query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionNode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionNode whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionNode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionNode whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionNode whereRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionNode whereStep($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionNode whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionNode withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionNode withoutTrashed()
 * @mixin \Eloquent
 */
class NotionNode extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'parent_id',
        'rank',
        'step'
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
}
