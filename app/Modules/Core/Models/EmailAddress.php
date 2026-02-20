<?php

namespace App\Modules\Core\Models;

use App\Modules\Todoist\Models\TodoistUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $full_value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Modules\Core\Models\Person> $people
 * @property-read int|null $people_count
 * @property-read TodoistUser|null $todoistUser
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailAddress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailAddress newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailAddress onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailAddress query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailAddress whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailAddress whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailAddress whereFullValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailAddress whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailAddress whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailAddress withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailAddress withoutTrashed()
 * @mixin \Eloquent
 */
class EmailAddress extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'full_value',
    ];

    public function people(): BelongsToMany
    {
        return $this->belongsToMany(Person::class)->withPivot('label')->withTimestamps();
    }

    public function todoistUser(): HasOne
    {
        return $this->hasOne(TodoistUser::class);
    }
}
