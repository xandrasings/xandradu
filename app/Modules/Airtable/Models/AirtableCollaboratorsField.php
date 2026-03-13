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
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCollaboratorsField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCollaboratorsField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCollaboratorsField onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCollaboratorsField query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCollaboratorsField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCollaboratorsField whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCollaboratorsField whereFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCollaboratorsField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCollaboratorsField whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCollaboratorsField withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableCollaboratorsField withoutTrashed()
 * @mixin \Eloquent
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
