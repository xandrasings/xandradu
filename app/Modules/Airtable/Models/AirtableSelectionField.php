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
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Modules\Airtable\Models\AirtableSelectionFieldChoice> $choices
 * @property-read int|null $choices_count
 * @property-read \App\Modules\Airtable\Models\AirtableField|null $field
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionField onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionField query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionField whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionField whereFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionField whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionField withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionField withoutTrashed()
 * @mixin \Eloquent
 */
class AirtableSelectionField extends Model
{
    use SoftDeletes;

    protected $fillable = [];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }

    public function choices(): HasMany
    {
        return $this->hasMany(AirtableSelectionFieldChoice::class, 'selection_field_id');
    }
}
