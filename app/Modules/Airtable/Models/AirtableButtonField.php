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
 * @method static Builder<static>|AirtableButtonField newModelQuery()
 * @method static Builder<static>|AirtableButtonField newQuery()
 * @method static Builder<static>|AirtableButtonField onlyTrashed()
 * @method static Builder<static>|AirtableButtonField query()
 * @method static Builder<static>|AirtableButtonField whereCreatedAt($value)
 * @method static Builder<static>|AirtableButtonField whereDeletedAt($value)
 * @method static Builder<static>|AirtableButtonField whereFieldId($value)
 * @method static Builder<static>|AirtableButtonField whereId($value)
 * @method static Builder<static>|AirtableButtonField whereUpdatedAt($value)
 * @method static Builder<static>|AirtableButtonField withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtableButtonField withoutTrashed()
 *
 * @mixin Eloquent
 */
class AirtableButtonField extends Model
{
    use SoftDeletes;

    protected $fillable = [];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }
}
