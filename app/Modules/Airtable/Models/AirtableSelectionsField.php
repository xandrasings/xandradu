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
 * @property-read Collection<int, AirtableSelectionsFieldChoice> $choices
 * @property-read int|null $choices_count
 * @property-read AirtableField $field
 * @method static Builder<static>|AirtableSelectionsField newModelQuery()
 * @method static Builder<static>|AirtableSelectionsField newQuery()
 * @method static Builder<static>|AirtableSelectionsField onlyTrashed()
 * @method static Builder<static>|AirtableSelectionsField query()
 * @method static Builder<static>|AirtableSelectionsField whereCreatedAt($value)
 * @method static Builder<static>|AirtableSelectionsField whereDeletedAt($value)
 * @method static Builder<static>|AirtableSelectionsField whereFieldId($value)
 * @method static Builder<static>|AirtableSelectionsField whereId($value)
 * @method static Builder<static>|AirtableSelectionsField whereUpdatedAt($value)
 * @method static Builder<static>|AirtableSelectionsField withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtableSelectionsField withoutTrashed()
 * @mixin Eloquent
 */
class AirtableSelectionsField extends Model
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
        return $this->hasMany(AirtableSelectionsFieldChoice::class, 'selections_field_id');
    }
}
