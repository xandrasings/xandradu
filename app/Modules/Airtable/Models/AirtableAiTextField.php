<?php

namespace App\Modules\Airtable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int|null $field_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Modules\Airtable\Models\AirtableField|null $field
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Modules\Airtable\Models\AirtableAiTextFieldPromptComponent> $promptComponents
 * @property-read int|null $prompt_components_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAiTextField newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAiTextField newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAiTextField onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAiTextField query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAiTextField whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAiTextField whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAiTextField whereFieldId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAiTextField whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAiTextField whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAiTextField withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AirtableAiTextField withoutTrashed()
 * @mixin \Eloquent
 */
class AirtableAiTextField extends Model
{
    use SoftDeletes;

    protected $fillable = [];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }

    public function promptComponents(): HasMany
    {
        return $this->hasMany(AirtableAiTextFieldPromptComponent::class, 'ai_text_field_id');
    }
}
