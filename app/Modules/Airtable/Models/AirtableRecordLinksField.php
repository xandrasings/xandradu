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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableRecordLinksField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableRecordLinksField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableRecordLinksField onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableRecordLinksField query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableRecordLinksField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableRecordLinksField whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableRecordLinksField whereFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableRecordLinksField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableRecordLinksField whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableRecordLinksField withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableRecordLinksField withoutTrashed()
 * @mixin \Eloquent
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
