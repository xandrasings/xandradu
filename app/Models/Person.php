<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
    ];

    public function emailAddresses(): BelongsToMany
    {
        return $this->belongsToMany(EmailAddress::class)->withPivot('label');
    }
}
