<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class TodoistUser extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'external_id',
        'email_address_id',
        'name'
    ];

    public function emailAddress(): BelongsTo
    {
        return $this->belongsTo(EmailAddress::class);
    }

    public function todoistAccount(): HasOne
    {
        return $this->hasOne(TodoistAccount::class, 'user_id');
    }
}
