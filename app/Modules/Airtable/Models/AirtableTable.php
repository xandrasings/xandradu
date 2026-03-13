<?php

namespace App\Modules\Airtable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int|null $base_id
 * @property string|null $external_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Modules\Airtable\Models\AirtableBase|null $base
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Modules\Airtable\Models\AirtableField> $fields
 * @property-read int|null $fields_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableTable newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableTable newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableTable onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableTable query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableTable whereBaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableTable whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableTable whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableTable whereExternalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableTable whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableTable whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableTable whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableTable withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableTable withoutTrashed()
 * @mixin \Eloquent
 */
class AirtableTable extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'external_id',
        'name',
    ];

    public function base(): BelongsTo
    {
        return $this->belongsTo(AirtableBase::class, 'base_id');
    }

    public function fields(): HasMany
    {
        return $this->hasMany(AirtableField::class, 'table_id');
    }
}
