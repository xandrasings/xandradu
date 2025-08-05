<?php

namespace App\Modules\Todoist\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

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
