<?php

namespace App\Modules\Airtable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int|null $field_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Modules\Airtable\Models\AirtableField|null $field
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableFormulaField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableFormulaField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableFormulaField onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableFormulaField query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableFormulaField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableFormulaField whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableFormulaField whereFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableFormulaField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableFormulaField whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableFormulaField withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableFormulaField withoutTrashed()
 *
 * @mixin \Eloquent
 */
class AirtableFormulaField extends Model
{
    use SoftDeletes;

    protected $fillable = [];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }
}
