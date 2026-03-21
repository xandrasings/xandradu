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
 * @method static Builder<static>|AirtableRecordLinksField newModelQuery()
 * @method static Builder<static>|AirtableRecordLinksField newQuery()
 * @method static Builder<static>|AirtableRecordLinksField onlyTrashed()
 * @method static Builder<static>|AirtableRecordLinksField query()
 * @method static Builder<static>|AirtableRecordLinksField whereCreatedAt($value)
 * @method static Builder<static>|AirtableRecordLinksField whereDeletedAt($value)
 * @method static Builder<static>|AirtableRecordLinksField whereFieldId($value)
 * @method static Builder<static>|AirtableRecordLinksField whereId($value)
 * @method static Builder<static>|AirtableRecordLinksField whereUpdatedAt($value)
 * @method static Builder<static>|AirtableRecordLinksField withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtableRecordLinksField withoutTrashed()
 *
 * @mixin Eloquent
 */
class AirtableRecordLinksField extends Model
{
    use SoftDeletes;

    protected $fillable = [];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }
}
