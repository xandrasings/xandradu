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
 * @method static Builder<static>|AirtablePhoneNumberField newModelQuery()
 * @method static Builder<static>|AirtablePhoneNumberField newQuery()
 * @method static Builder<static>|AirtablePhoneNumberField onlyTrashed()
 * @method static Builder<static>|AirtablePhoneNumberField query()
 * @method static Builder<static>|AirtablePhoneNumberField whereCreatedAt($value)
 * @method static Builder<static>|AirtablePhoneNumberField whereDeletedAt($value)
 * @method static Builder<static>|AirtablePhoneNumberField whereFieldId($value)
 * @method static Builder<static>|AirtablePhoneNumberField whereId($value)
 * @method static Builder<static>|AirtablePhoneNumberField whereUpdatedAt($value)
 * @method static Builder<static>|AirtablePhoneNumberField withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtablePhoneNumberField withoutTrashed()
 *
 * @mixin Eloquent
 */
class AirtablePhoneNumberField extends Model
{
    use SoftDeletes;

    protected $fillable = [];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }
}
