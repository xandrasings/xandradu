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
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtablePhoneNumberField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtablePhoneNumberField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtablePhoneNumberField onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtablePhoneNumberField query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtablePhoneNumberField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtablePhoneNumberField whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtablePhoneNumberField whereFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtablePhoneNumberField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtablePhoneNumberField whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtablePhoneNumberField withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtablePhoneNumberField withoutTrashed()
 *
 * @mixin \Eloquent
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
