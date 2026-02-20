<?php

namespace App\Modules\Todoist\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Modules\Todoist\Models\TodoistProject|null $project
 * @property-read \App\Modules\Todoist\Models\TodoistSection|null $section
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistNode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistNode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistNode query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistNode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistNode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistNode whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TodoistNode extends Model
{
    protected $fillable = [];

    public function project(): HasOne
    {
        return $this->hasOne(TodoistProject::class, 'node_id');
    }

    public function section(): HasOne
    {
        return $this->hasOne(TodoistSection::class, 'node_id');
    }
}
