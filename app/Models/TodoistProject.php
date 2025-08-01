<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class TodoistProject extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'location_reference_id',
        'external_id',
        'name',
        'color_id',
        'is_favorite'
    ];

    protected $casts = [
        'is_favorite' => 'boolean',
    ];

    public function locationReference(): BelongsTo
    {
        return $this->belongsTo(TodoistTaskLocation::class, 'location_reference_id');
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
