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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read AirtableField $field
 *
 * @method static Builder<static>|AirtableShortTextField newModelQuery()
 * @method static Builder<static>|AirtableShortTextField newQuery()
 * @method static Builder<static>|AirtableShortTextField onlyTrashed()
 * @method static Builder<static>|AirtableShortTextField query()
 * @method static Builder<static>|AirtableShortTextField whereCreatedAt($value)
 * @method static Builder<static>|AirtableShortTextField whereDeletedAt($value)
 * @method static Builder<static>|AirtableShortTextField whereFieldId($value)
 * @method static Builder<static>|AirtableShortTextField whereId($value)
 * @method static Builder<static>|AirtableShortTextField whereUpdatedAt($value)
 * @method static Builder<static>|AirtableShortTextField withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtableShortTextField withoutTrashed()
 *
 * @mixin Eloquent
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
