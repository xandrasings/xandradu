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
 * @property int|null $field_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read AirtableField|null $field
 *
 * @method static Builder<static>|AirtableCollaboratorField newModelQuery()
 * @method static Builder<static>|AirtableCollaboratorField newQuery()
 * @method static Builder<static>|AirtableCollaboratorField onlyTrashed()
 * @method static Builder<static>|AirtableCollaboratorField query()
 * @method static Builder<static>|AirtableCollaboratorField whereCreatedAt($value)
 * @method static Builder<static>|AirtableCollaboratorField whereDeletedAt($value)
 * @method static Builder<static>|AirtableCollaboratorField whereFieldId($value)
 * @method static Builder<static>|AirtableCollaboratorField whereId($value)
 * @method static Builder<static>|AirtableCollaboratorField whereUpdatedAt($value)
 * @method static Builder<static>|AirtableCollaboratorField withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtableCollaboratorField withoutTrashed()
 *
 * @mixin Eloquent
 */
class AirtableCollaboratorField extends Model
{
    use SoftDeletes;

    protected $fillable = [];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }
}
