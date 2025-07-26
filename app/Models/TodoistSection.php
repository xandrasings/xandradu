<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TodoistSection extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'location_reference_id',
        'project_id',
        'rank',
        'external_id',
        'name'
    ];

    public function locationReference(): BelongsTo
    {
        return $this->belongsTo(TodoistTaskLocation::class, 'location_reference_id');
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(TodoistProject::class, 'todoist_project_user')->withPivot('parent_project_id', 'rank')->withTimestamps();
    }
}
