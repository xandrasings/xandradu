<?php

namespace App\Modules\Airtable\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $formula_field_id
 * @property int|null $referenced_field_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read AirtableFormulaField $formulaField
 * @property-read AirtableField|null $referencedField
 * @method static Builder<static>|AirtableFormulaFieldField newModelQuery()
 * @method static Builder<static>|AirtableFormulaFieldField newQuery()
 * @method static Builder<static>|AirtableFormulaFieldField onlyTrashed()
 * @method static Builder<static>|AirtableFormulaFieldField query()
 * @method static Builder<static>|AirtableFormulaFieldField whereCreatedAt($value)
 * @method static Builder<static>|AirtableFormulaFieldField whereDeletedAt($value)
 * @method static Builder<static>|AirtableFormulaFieldField whereFormulaFieldId($value)
 * @method static Builder<static>|AirtableFormulaFieldField whereId($value)
 * @method static Builder<static>|AirtableFormulaFieldField whereReferencedFieldId($value)
 * @method static Builder<static>|AirtableFormulaFieldField whereUpdatedAt($value)
 * @method static Builder<static>|AirtableFormulaFieldField withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtableFormulaFieldField withoutTrashed()
 * @mixin Eloquent
 */
class AirtableFormulaFieldField extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'referenced_field_id',
    ];

    public function formulaField(): BelongsTo
    {
        return $this->belongsTo(AirtableFormulaField::class, 'formula_field_id');
    }

    public function referencedField(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'referenced_field_id');
    }
}
