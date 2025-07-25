<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TodoistAccount extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'access_token',
        'sync_token'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(TodoistUser::class, 'user_id');
    }
}
