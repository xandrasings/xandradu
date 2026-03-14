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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionsField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionsField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionsField onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionsField query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionsField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionsField whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionsField whereFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionsField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionsField whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionsField withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionsField withoutTrashed()
 * @mixin \Eloquent
 */
class AirtableSelectionsFieldChoice extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'external_id',
        'name',
        'color',
    ];

    public function selectionsField(): BelongsTo
    {
        return $this->belongsTo(AirtableSelectionsField::class, 'selections_field_id');
    }
}
