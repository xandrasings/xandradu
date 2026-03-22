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
 * @property-read Collection<int, AirtableSelectionFieldChoice> $choices
 * @property-read int|null $choices_count
 * @property-read AirtableField $field
 * @method static Builder<static>|AirtableSelectionField newModelQuery()
 * @method static Builder<static>|AirtableSelectionField newQuery()
 * @method static Builder<static>|AirtableSelectionField onlyTrashed()
 * @method static Builder<static>|AirtableSelectionField query()
 * @method static Builder<static>|AirtableSelectionField whereCreatedAt($value)
 * @method static Builder<static>|AirtableSelectionField whereDeletedAt($value)
 * @method static Builder<static>|AirtableSelectionField whereFieldId($value)
 * @method static Builder<static>|AirtableSelectionField whereId($value)
 * @method static Builder<static>|AirtableSelectionField whereUpdatedAt($value)
 * @method static Builder<static>|AirtableSelectionField withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtableSelectionField withoutTrashed()
 * @mixin Eloquent
 */
class AirtableSelectionField extends Model
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
        return $this->hasMany(AirtableSelectionFieldChoice::class, 'selection_field_id');
    }
}
