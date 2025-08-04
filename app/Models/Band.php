<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Band extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
    ];

    public function wiki(): HasOne
    {
        return $this->hasOne(BandWiki::class);
    }
}
