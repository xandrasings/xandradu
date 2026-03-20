<?php

namespace App\Modules\Airtable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int|null $field_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Modules\Airtable\Models\AirtableSyncSourceFieldChoice> $choices
 * @property-read int|null $choices_count
 * @property-read \App\Modules\Airtable\Models\AirtableField|null $field
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSyncSourceField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSyncSourceField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSyncSourceField onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSyncSourceField query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSyncSourceField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSyncSourceField whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSyncSourceField whereFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSyncSourceField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSyncSourceField whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSyncSourceField withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSyncSourceField withoutTrashed()
 *
 * @mixin \Eloquent
 */
class AirtableSyncSourceField extends Model
{
    use SoftDeletes;

    protected $fillable = [];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }

    public function choices(): HasMany
    {
        return $this->hasMany(AirtableSyncSourceFieldChoice::class, 'sync_source_field_id');
    }
}
