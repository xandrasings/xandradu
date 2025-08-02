<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class NotionWorkspace extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
    ];

    public function workspace(): HasMany
    {
        return $this->hasMany(NotionBot::class, 'workspace_id');
    }
}
