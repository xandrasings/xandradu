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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableEmailAddressField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableEmailAddressField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableEmailAddressField onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableEmailAddressField query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableEmailAddressField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableEmailAddressField whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableEmailAddressField whereFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableEmailAddressField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableEmailAddressField whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableEmailAddressField withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableEmailAddressField withoutTrashed()
 * @mixin \Eloquent
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
