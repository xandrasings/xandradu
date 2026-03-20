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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAutoNumberField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAutoNumberField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAutoNumberField onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAutoNumberField query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAutoNumberField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAutoNumberField whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAutoNumberField whereFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAutoNumberField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAutoNumberField whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAutoNumberField withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAutoNumberField withoutTrashed()
 *
 * @mixin \Eloquent
 */
class AirtableAutoNumberField extends Model
{
    use SoftDeletes;

    protected $fillable = [];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }
}
