<?php

namespace App\Modules\Notion\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $node_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Modules\Notion\Models\NotionBot> $bots
 * @property-read int|null $bots_count
 * @property-read \App\Modules\Notion\Models\NotionNode $node
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionWorkspace newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionWorkspace newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionWorkspace query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionWorkspace whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionWorkspace whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionWorkspace whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionWorkspace whereNodeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NotionWorkspace whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
