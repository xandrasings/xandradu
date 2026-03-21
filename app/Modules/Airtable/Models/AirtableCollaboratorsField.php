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
 * @method static Builder<static>|AirtableCollaboratorsField newModelQuery()
 * @method static Builder<static>|AirtableCollaboratorsField newQuery()
 * @method static Builder<static>|AirtableCollaboratorsField onlyTrashed()
 * @method static Builder<static>|AirtableCollaboratorsField query()
 * @method static Builder<static>|AirtableCollaboratorsField whereCreatedAt($value)
 * @method static Builder<static>|AirtableCollaboratorsField whereDeletedAt($value)
 * @method static Builder<static>|AirtableCollaboratorsField whereFieldId($value)
 * @method static Builder<static>|AirtableCollaboratorsField whereId($value)
 * @method static Builder<static>|AirtableCollaboratorsField whereUpdatedAt($value)
 * @method static Builder<static>|AirtableCollaboratorsField withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtableCollaboratorsField withoutTrashed()
 *
 * @mixin Eloquent
 */
class AirtableCollaboratorsField extends Model
{
    use SoftDeletes;

    protected $fillable = [];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }
}
