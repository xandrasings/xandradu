<?php

namespace App\Modules\Todoist\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $node_id
 * @property string|null $external_id
 * @property string $name
 * @property int $color_id
 * @property bool $is_favorite
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Modules\Todoist\Models\TodoistNode $node
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Modules\Todoist\Models\TodoistSection> $sections
 * @property-read int|null $sections_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Modules\Todoist\Models\TodoistUser> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistProject newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistProject newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistProject onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistProject query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistProject whereColorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistProject whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistProject whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistProject whereExternalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistProject whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistProject whereIsFavorite($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistProject whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistProject whereNodeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistProject whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistProject withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistProject withoutTrashed()
 * @mixin \Eloquent
 */
class TodoistProject extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'node_id',
        'external_id',
        'name',
        'color_id',
        'is_favorite'
    ];

    protected $casts = [
        'is_favorite' => 'boolean',
    ];

    public function node(): BelongsTo
    {
        return $this->belongsTo(TodoistNode::class, 'node_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(TodoistUser::class, 'todoist_project_user', 'project_id', 'user_id')->withPivot('parent_project_id', 'rank')->withTimestamps();
    }

    public function sections(): HasMany
    {
        return $this->hasMany(TodoistSection::class, 'project_id');
    }
}
