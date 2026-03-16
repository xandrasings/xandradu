<?php

namespace App\Modules\Airtable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int|null $selections_field_id
 * @property string|null $external_id
 * @property string $name
 * @property string|null $color
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Modules\Airtable\Models\AirtableSelectionsField|null $selectionsField
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionsFieldChoice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionsFieldChoice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionsFieldChoice onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionsFieldChoice query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionsFieldChoice whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionsFieldChoice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionsFieldChoice whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionsFieldChoice whereExternalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionsFieldChoice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionsFieldChoice whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionsFieldChoice whereSelectionsFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionsFieldChoice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionsFieldChoice withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableSelectionsFieldChoice withoutTrashed()
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
