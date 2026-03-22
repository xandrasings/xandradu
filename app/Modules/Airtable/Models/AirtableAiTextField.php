<?php

namespace App\Modules\Airtable\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $field_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read AirtableField $field
 * @property-read Collection<int, AirtableAiTextFieldPromptComponent> $promptComponents
 * @property-read int|null $prompt_components_count
 * @method static Builder<static>|AirtableAiTextField newModelQuery()
 * @method static Builder<static>|AirtableAiTextField newQuery()
 * @method static Builder<static>|AirtableAiTextField onlyTrashed()
 * @method static Builder<static>|AirtableAiTextField query()
 * @method static Builder<static>|AirtableAiTextField whereCreatedAt($value)
 * @method static Builder<static>|AirtableAiTextField whereDeletedAt($value)
 * @method static Builder<static>|AirtableAiTextField whereFieldId($value)
 * @method static Builder<static>|AirtableAiTextField whereId($value)
 * @method static Builder<static>|AirtableAiTextField whereUpdatedAt($value)
 * @method static Builder<static>|AirtableAiTextField withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtableAiTextField withoutTrashed()
 * @mixin Eloquent
 */
class AirtableAiTextField extends Model
{
    use CascadeSoftDeletes, SoftDeletes;

    protected $fillable = [];

    protected array $cascadeDeletes = [
        'promptComponents',
    ];

    public function field(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'field_id');
    }

    public function promptComponents(): HasMany
    {
        return $this->hasMany(AirtableAiTextFieldPromptComponent::class, 'ai_text_field_id');
    }
}
