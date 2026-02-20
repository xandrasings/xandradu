<?php

namespace App\Modules\Core\Models;

use App\Modules\Notion\Models\NotionDatabase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $type
 * @property string $name
 * @property string $path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, NotionDatabase> $icon
 * @property-read int|null $icon_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StoredFile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StoredFile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StoredFile onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StoredFile query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StoredFile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StoredFile whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StoredFile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StoredFile whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StoredFile wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StoredFile whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StoredFile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StoredFile withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|StoredFile withoutTrashed()
 * @mixin \Eloquent
 */
class StoredFile extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'type',
        'name',
        'path',
    ];

    public function icon(): HasMany
    {
        return $this->hasMany(NotionDatabase::class, 'icon_id');
    }
}
