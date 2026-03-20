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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableLookupField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableLookupField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableLookupField onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableLookupField query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableLookupField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableLookupField whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableLookupField whereFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableLookupField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableLookupField whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableLookupField withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableLookupField withoutTrashed()
 *
 * @mixin \Eloquent
 */
class AirtableLookupField extends Model
{
    use SoftDeletes;

    protected $fillable = [];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }
}
