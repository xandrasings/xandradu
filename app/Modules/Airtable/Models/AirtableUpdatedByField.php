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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableUpdatedByField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableUpdatedByField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableUpdatedByField onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableUpdatedByField query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableUpdatedByField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableUpdatedByField whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableUpdatedByField whereFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableUpdatedByField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableUpdatedByField whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableUpdatedByField withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableUpdatedByField withoutTrashed()
 * @mixin \Eloquent
 */
class AirtableUpdatedByField extends Model
{
    use SoftDeletes;

    protected $fillable = [];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }
}
