<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmailAddressPerson extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'label',
    ];

    public function emailAddresses(): BelongsToMany
    {
        return $this->belongsToMany(EmailAddress::class)->withPivot('label')->withTimestamps();

    }
}
