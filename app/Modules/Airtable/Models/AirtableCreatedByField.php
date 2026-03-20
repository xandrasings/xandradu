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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCreatedByField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCreatedByField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCreatedByField onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCreatedByField query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCreatedByField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCreatedByField whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCreatedByField whereFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCreatedByField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCreatedByField whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCreatedByField withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCreatedByField withoutTrashed()
 *
 * @mixin \Eloquent
 */
class AirtableCreatedByField extends Model
{
    use SoftDeletes;

    protected $fillable = [];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }
}
