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
 * @method static Builder<static>|AirtableEmailAddressField newModelQuery()
 * @method static Builder<static>|AirtableEmailAddressField newQuery()
 * @method static Builder<static>|AirtableEmailAddressField onlyTrashed()
 * @method static Builder<static>|AirtableEmailAddressField query()
 * @method static Builder<static>|AirtableEmailAddressField whereCreatedAt($value)
 * @method static Builder<static>|AirtableEmailAddressField whereDeletedAt($value)
 * @method static Builder<static>|AirtableEmailAddressField whereFieldId($value)
 * @method static Builder<static>|AirtableEmailAddressField whereId($value)
 * @method static Builder<static>|AirtableEmailAddressField whereUpdatedAt($value)
 * @method static Builder<static>|AirtableEmailAddressField withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtableEmailAddressField withoutTrashed()
 * @mixin Eloquent
 */
class AirtableEmailAddressField extends Model
{
    use SoftDeletes;

    protected $fillable = [];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }
}
