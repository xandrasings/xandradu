<?php

namespace App\Modules\Todoist\Models;

use App\Modules\Core\Models\EmailAddress;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $external_id
 * @property int $email_address_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Modules\Todoist\Models\TodoistAccount|null $account
 * @property-read EmailAddress $emailAddress
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Modules\Todoist\Models\TodoistProject> $projects
 * @property-read int|null $projects_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistUser onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistUser query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistUser whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistUser whereEmailAddressId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistUser whereExternalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistUser whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistUser withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TodoistUser withoutTrashed()
 * @mixin \Eloquent
 */
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

    public function account(): HasOne
    {
        return $this->hasOne(TodoistAccount::class, 'user_id');
    }

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(TodoistProject::class, 'todoist_project_user', 'user_id', 'project_id')->withPivot('parent_project_id', 'rank')->withTimestamps();
    }
}
