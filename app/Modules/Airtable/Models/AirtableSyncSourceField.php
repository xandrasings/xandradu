<?php

namespace App\Modules\Airtable\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $field_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Collection<int, AirtableSyncSourceFieldChoice> $choices
 * @property-read int|null $choices_count
 * @property-read AirtableField $field
 * @method static Builder<static>|AirtableSyncSourceField newModelQuery()
 * @method static Builder<static>|AirtableSyncSourceField newQuery()
 * @method static Builder<static>|AirtableSyncSourceField onlyTrashed()
 * @method static Builder<static>|AirtableSyncSourceField query()
 * @method static Builder<static>|AirtableSyncSourceField whereCreatedAt($value)
 * @method static Builder<static>|AirtableSyncSourceField whereDeletedAt($value)
 * @method static Builder<static>|AirtableSyncSourceField whereFieldId($value)
 * @method static Builder<static>|AirtableSyncSourceField whereId($value)
 * @method static Builder<static>|AirtableSyncSourceField whereUpdatedAt($value)
 * @method static Builder<static>|AirtableSyncSourceField withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtableSyncSourceField withoutTrashed()
 * @mixin Eloquent
 */
class AirtableSyncSourceField extends Model
{
    use CascadeSoftDeletes, SoftDeletes;

    protected $fillable = [];

    protected array $cascadeDeletes = [
        'choices',
    ];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }

    public function choices(): HasMany
    {
        return $this->hasMany(AirtableSyncSourceFieldChoice::class, 'sync_source_field_id');
    }
}
