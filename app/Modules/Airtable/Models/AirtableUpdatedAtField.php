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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableUpdatedAtField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableUpdatedAtField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableUpdatedAtField onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableUpdatedAtField query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableUpdatedAtField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableUpdatedAtField whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableUpdatedAtField whereFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableUpdatedAtField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableUpdatedAtField whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableUpdatedAtField withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableUpdatedAtField withoutTrashed()
 * @mixin \Eloquent
 */
class AirtableUpdatedAtField extends Model
{
    use SoftDeletes;

    protected $fillable = [];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }
}
