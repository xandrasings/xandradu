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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableRollupField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableRollupField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableRollupField onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableRollupField query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableRollupField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableRollupField whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableRollupField whereFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableRollupField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableRollupField whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableRollupField withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableRollupField withoutTrashed()
 * @mixin \Eloquent
 */
class AirtableRollupField extends Model
{
    use SoftDeletes;

    protected $fillable = [];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }
}
