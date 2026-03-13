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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCollaboratorField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCollaboratorField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCollaboratorField onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCollaboratorField query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCollaboratorField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCollaboratorField whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCollaboratorField whereFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCollaboratorField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCollaboratorField whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCollaboratorField withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCollaboratorField withoutTrashed()
 * @mixin \Eloquent
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
