<?php

namespace App\Modules\Todoist\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
