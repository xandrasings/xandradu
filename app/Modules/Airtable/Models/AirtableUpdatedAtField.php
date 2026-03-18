<?php

namespace App\Modules\Airtable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class AirtableUpdatedAtField extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'format',
        'type',
    ];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }

    public function dateTimeUpdatedAtField(): HasOne
    {
        return $this->hasOne(AirtableDateTimeUpdatedAtField::class, 'updated_at_field_id');
    }

    public function dateUpdatedAtField(): HasOne
    {
        return $this->hasOne(AirtableDateUpdatedAtField::class, 'updated_at_field_id');
    }

    public function fields(): HasMany
    {
        return $this->hasMany(AirtableUpdatedAtFieldField::class, 'updated_at_field_id');
    }
}
