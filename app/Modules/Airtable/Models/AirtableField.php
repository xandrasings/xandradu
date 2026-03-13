<?php

namespace App\Modules\Airtable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int|null $table_id
 * @property string|null $external_id
 * @property string $name
 * @property string|null $description
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Modules\Airtable\Models\AirtableAttachmentsField|null $attachmentsField
 * @property-read \App\Modules\Airtable\Models\AirtableCheckboxField|null $checkboxField
 * @property-read \App\Modules\Airtable\Models\AirtableMultipleLineField|null $multipleLineField
 * @property-read \App\Modules\Airtable\Models\AirtableSingleLineField|null $singleLineField
 * @property-read \App\Modules\Airtable\Models\AirtableTable|null $table
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableField onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableField query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableField whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableField whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableField whereExternalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableField whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableField whereTableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableField whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableField whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableField withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableField withoutTrashed()
 * @mixin \Eloquent
 */
class AirtableField extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'external_id',
        'name',
        'description',
        'type',
    ];

    public function table(): BelongsTo
    {
        return $this->belongsTo(AirtableTable::class, 'table_id');
    }

    public function attachmentsField(): HasOne
    {
        return $this->hasOne(AirtableAttachmentsField::class, 'field_id');
    }

    public function checkboxField(): HasOne
    {
        return $this->hasOne(AirtableCheckboxField::class, 'field_id');
    }

    public function multipleLineField(): HasOne
    {
        return $this->hasOne(AirtableMultipleLineField::class, 'field_id');
    }

    public function singleLineField(): HasOne
    {
        return $this->hasOne(AirtableSingleLineField::class, 'field_id');
    }
}
