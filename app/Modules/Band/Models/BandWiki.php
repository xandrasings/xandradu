<?php

namespace App\Modules\Band\Models;

use App\Modules\Notion\Models\NotionNode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $band_id
 * @property int $notion_node_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Modules\Band\Models\Band $band
 * @property-read NotionNode $node
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BandWiki newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BandWiki newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BandWiki onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BandWiki query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BandWiki whereBandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BandWiki whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BandWiki whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BandWiki whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BandWiki whereNotionNodeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BandWiki whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BandWiki withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BandWiki withoutTrashed()
 * @mixin \Eloquent
 */
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

    public function node(): BelongsTo
    {
        return $this->belongsTo(NotionNode::class, 'notion_node_id');
    }
}
