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
 * @property int $field_id
 * @property int $precision
 * @property string $symbol
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read AirtableField $field
 * @method static Builder<static>|AirtableCurrencyField newModelQuery()
 * @method static Builder<static>|AirtableCurrencyField newQuery()
 * @method static Builder<static>|AirtableCurrencyField onlyTrashed()
 * @method static Builder<static>|AirtableCurrencyField query()
 * @method static Builder<static>|AirtableCurrencyField whereCreatedAt($value)
 * @method static Builder<static>|AirtableCurrencyField whereDeletedAt($value)
 * @method static Builder<static>|AirtableCurrencyField whereFieldId($value)
 * @method static Builder<static>|AirtableCurrencyField whereId($value)
 * @method static Builder<static>|AirtableCurrencyField wherePrecision($value)
 * @method static Builder<static>|AirtableCurrencyField whereSymbol($value)
 * @method static Builder<static>|AirtableCurrencyField whereUpdatedAt($value)
 * @method static Builder<static>|AirtableCurrencyField withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtableCurrencyField withoutTrashed()
 * @mixin Eloquent
 */
class AirtableCurrencyField extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'precision',
        'symbol',
    ];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }
}
