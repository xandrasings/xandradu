<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TodoistTaskLocation extends Model
{
    protected $fillable = [];

    public function account(): HasOne
    {
        return $this->hasOne(TodoistProject::class, 'location_reference_id');
    }
}
