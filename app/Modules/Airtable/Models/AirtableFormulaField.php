<?php

namespace App\Modules\Airtable\Models;

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
 * @property string $formula
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read AirtableField $field
 * @property-read Collection<int, AirtableFormulaFieldField> $referencedFields
 * @property-read int|null $referenced_fields_count
 *
 * @method static Builder<static>|AirtableFormulaField newModelQuery()
 * @method static Builder<static>|AirtableFormulaField newQuery()
 * @method static Builder<static>|AirtableFormulaField onlyTrashed()
 * @method static Builder<static>|AirtableFormulaField query()
 * @method static Builder<static>|AirtableFormulaField whereCreatedAt($value)
 * @method static Builder<static>|AirtableFormulaField whereDeletedAt($value)
 * @method static Builder<static>|AirtableFormulaField whereFieldId($value)
 * @method static Builder<static>|AirtableFormulaField whereFormula($value)
 * @method static Builder<static>|AirtableFormulaField whereId($value)
 * @method static Builder<static>|AirtableFormulaField whereUpdatedAt($value)
 * @method static Builder<static>|AirtableFormulaField withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtableFormulaField withoutTrashed()
 *
 * @mixin Eloquent
 */
class AirtableFormulaField extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'formula',
    ];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }

    public function referencedFields(): HasMany
    {
        return $this->hasMany(AirtableFormulaFieldField::class, 'formula_field_id');
    }
}
