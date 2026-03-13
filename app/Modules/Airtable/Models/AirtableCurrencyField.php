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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCurrencyField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCurrencyField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCurrencyField onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCurrencyField query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCurrencyField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCurrencyField whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCurrencyField whereFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCurrencyField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCurrencyField whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCurrencyField withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCurrencyField withoutTrashed()
 * @mixin \Eloquent
 */
class AirtableCurrencyField extends Model
{
    use SoftDeletes;

    protected $fillable = [];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }
}
