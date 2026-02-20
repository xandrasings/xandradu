<?php

namespace App\Modules\Todoist\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $node_id
 * @property int|null $project_id
 * @property int $rank
 * @property string|null $external_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Modules\Todoist\Models\TodoistNode $node
 * @property-read \App\Modules\Todoist\Models\TodoistProject|null $project
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistSection newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistSection newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistSection onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistSection query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistSection whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistSection whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistSection whereExternalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistSection whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistSection whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistSection whereNodeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistSection whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistSection whereRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistSection whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistSection withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistSection withoutTrashed()
 * @mixin \Eloquent
 */
class TodoistSection extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'node_id',
        'project_id',
        'rank',
        'external_id',
        'name'
    ];

    public function node(): BelongsTo
    {
        return $this->belongsTo(TodoistNode::class, 'node_id');
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(TodoistProject::class, 'project_id');
    }
}
