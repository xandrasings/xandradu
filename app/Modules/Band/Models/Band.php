<?php

namespace App\Modules\Band\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Modules\Band\Models\BandWiki|null $wiki
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Band newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Band newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Band onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Band query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Band whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Band whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Band whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Band whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Band whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Band withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Band withoutTrashed()
 * @mixin \Eloquent
 */
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
