<?php

namespace App\Modules\Todoist\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $code
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistColor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistColor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistColor onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistColor query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistColor whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistColor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistColor whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistColor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistColor whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistColor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistColor withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistColor withoutTrashed()
 * @mixin \Eloquent
 */
class TodoistColor extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'code',
        'name',
    ];
}
