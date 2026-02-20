<?php

namespace App\Modules\Todoist\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $user_id
 * @property string $access_token
 * @property string|null $sync_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Modules\Todoist\Models\TodoistUser $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistAccount onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistAccount query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistAccount whereAccessToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistAccount whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistAccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistAccount whereSyncToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistAccount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistAccount whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistAccount withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistAccount withoutTrashed()
 * @mixin \Eloquent
 */
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
