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
 * @property int $selections_field_id
 * @property int $rank
 * @property string|null $external_id
 * @property string $name
 * @property string|null $color
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read AirtableSelectionsField $selectionsField
 * @method static Builder<static>|AirtableSelectionsFieldChoice newModelQuery()
 * @method static Builder<static>|AirtableSelectionsFieldChoice newQuery()
 * @method static Builder<static>|AirtableSelectionsFieldChoice onlyTrashed()
 * @method static Builder<static>|AirtableSelectionsFieldChoice query()
 * @method static Builder<static>|AirtableSelectionsFieldChoice whereColor($value)
 * @method static Builder<static>|AirtableSelectionsFieldChoice whereCreatedAt($value)
 * @method static Builder<static>|AirtableSelectionsFieldChoice whereDeletedAt($value)
 * @method static Builder<static>|AirtableSelectionsFieldChoice whereExternalId($value)
 * @method static Builder<static>|AirtableSelectionsFieldChoice whereId($value)
 * @method static Builder<static>|AirtableSelectionsFieldChoice whereName($value)
 * @method static Builder<static>|AirtableSelectionsFieldChoice whereRank($value)
 * @method static Builder<static>|AirtableSelectionsFieldChoice whereSelectionsFieldId($value)
 * @method static Builder<static>|AirtableSelectionsFieldChoice whereUpdatedAt($value)
 * @method static Builder<static>|AirtableSelectionsFieldChoice withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtableSelectionsFieldChoice withoutTrashed()
 * @mixin Eloquent
 */
class AirtableSelectionsFieldChoice extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'rank',
        'external_id',
        'name',
        'color',
    ];

    public function selectionsField(): BelongsTo
    {
        return $this->belongsTo(AirtableSelectionsField::class, 'selections_field_id');
    }
}
