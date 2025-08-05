<?php

namespace App\Modules\Core\Models;

use App\Modules\Todoist\Models\TodoistUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

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
