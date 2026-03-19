<?php

namespace App\Modules\Airtable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int|null $updated_at_field_id
 * @property int|null $field_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Modules\Airtable\Models\AirtableField|null $field
 * @property-read \App\Modules\Airtable\Models\AirtableUpdatedAtField|null $updatedAtField
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableUpdatedAtFieldField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableUpdatedAtFieldField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableUpdatedAtFieldField onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableUpdatedAtFieldField query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableUpdatedAtFieldField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableUpdatedAtFieldField whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableUpdatedAtFieldField whereFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableUpdatedAtFieldField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableUpdatedAtFieldField whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableUpdatedAtFieldField whereUpdatedAtFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableUpdatedAtFieldField withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableUpdatedAtFieldField withoutTrashed()
 * @mixin \Eloquent
 */
class AirtableUpdatedAtFieldField extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'field_id'
    ];

    public function updatedAtField(): BelongsTo
    {
        return $this->belongsTo(AirtableUpdatedAtField::class, 'updated_at_field_id');
    }

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }
}
