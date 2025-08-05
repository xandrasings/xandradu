<?php

namespace App\Modules\Todoist\Models;

use App\Modules\Core\Models\EmailAddress;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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

    public function account(): HasOne
    {
        return $this->hasOne(TodoistAccount::class, 'user_id');
    }

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(TodoistProject::class, 'todoist_project_user', 'user_id', 'project_id')->withPivot('parent_project_id', 'rank')->withTimestamps();
    }
}
