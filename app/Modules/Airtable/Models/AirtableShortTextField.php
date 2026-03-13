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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableShortTextField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableShortTextField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableShortTextField onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableShortTextField query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableShortTextField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableShortTextField whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableShortTextField whereFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableShortTextField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableShortTextField whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableShortTextField withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableShortTextField withoutTrashed()
 * @mixin \Eloquent
 */
class AirtableShortTextField extends Model
{
    use SoftDeletes;

    protected $fillable = [];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }
}
