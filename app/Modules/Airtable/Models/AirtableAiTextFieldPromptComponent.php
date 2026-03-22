<?php

namespace App\Modules\Airtable\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $ai_text_field_id
 * @property int $rank
 * @property string $type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read AirtableAiTextField $aiTextField
 * @property-read AirtableAiTextFieldFieldPromptComponent|null $fieldPromptComponent
 * @property-read AirtableAiTextFieldTextPromptComponent|null $textPromptComponent
 * @method static Builder<static>|AirtableAiTextFieldPromptComponent newModelQuery()
 * @method static Builder<static>|AirtableAiTextFieldPromptComponent newQuery()
 * @method static Builder<static>|AirtableAiTextFieldPromptComponent onlyTrashed()
 * @method static Builder<static>|AirtableAiTextFieldPromptComponent query()
 * @method static Builder<static>|AirtableAiTextFieldPromptComponent whereAiTextFieldId($value)
 * @method static Builder<static>|AirtableAiTextFieldPromptComponent whereCreatedAt($value)
 * @method static Builder<static>|AirtableAiTextFieldPromptComponent whereDeletedAt($value)
 * @method static Builder<static>|AirtableAiTextFieldPromptComponent whereId($value)
 * @method static Builder<static>|AirtableAiTextFieldPromptComponent whereRank($value)
 * @method static Builder<static>|AirtableAiTextFieldPromptComponent whereType($value)
 * @method static Builder<static>|AirtableAiTextFieldPromptComponent whereUpdatedAt($value)
 * @method static Builder<static>|AirtableAiTextFieldPromptComponent withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtableAiTextFieldPromptComponent withoutTrashed()
 * @mixin Eloquent
 */
class AirtableAiTextFieldPromptComponent extends Model
{
    use CascadeSoftDeletes, SoftDeletes;

    protected $fillable = [
        'rank',
        'type',
    ];

    protected array $cascadeDeletes = [
        'fieldPromptComponent',
        'textPromptComponent',
    ];

    public function aiTextField(): BelongsTo
    {
        return $this->belongsTo(AirtableAiTextField::class, 'ai_text_field_id');
    }

    public function fieldPromptComponent(): HasOne
    {
        return $this->hasOne(AirtableAiTextFieldFieldPromptComponent::class, 'prompt_component_id');
    }

    public function textPromptComponent(): HasOne
    {
        return $this->hasOne(AirtableAiTextFieldTextPromptComponent::class, 'prompt_component_id');
    }
}
