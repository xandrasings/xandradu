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
 * @property int|null $field_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read AirtableField|null $field
 *
 * @method static Builder<static>|AirtableLongTextField newModelQuery()
 * @method static Builder<static>|AirtableLongTextField newQuery()
 * @method static Builder<static>|AirtableLongTextField onlyTrashed()
 * @method static Builder<static>|AirtableLongTextField query()
 * @method static Builder<static>|AirtableLongTextField whereCreatedAt($value)
 * @method static Builder<static>|AirtableLongTextField whereDeletedAt($value)
 * @method static Builder<static>|AirtableLongTextField whereFieldId($value)
 * @method static Builder<static>|AirtableLongTextField whereId($value)
 * @method static Builder<static>|AirtableLongTextField whereUpdatedAt($value)
 * @method static Builder<static>|AirtableLongTextField withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtableLongTextField withoutTrashed()
 *
 * @mixin Eloquent
 */
class AirtableLongTextField extends Model
{
    use SoftDeletes;

    protected $fillable = [];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }
}
