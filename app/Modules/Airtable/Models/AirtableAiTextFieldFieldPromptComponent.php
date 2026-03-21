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
 * @property int|null $prompt_component_id
 * @property int|null $referenced_field_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read AirtableAiTextFieldPromptComponent|null $promptComponent
 * @property-read AirtableField|null $referencedField
 *
 * @method static Builder<static>|AirtableAiTextFieldFieldPromptComponent newModelQuery()
 * @method static Builder<static>|AirtableAiTextFieldFieldPromptComponent newQuery()
 * @method static Builder<static>|AirtableAiTextFieldFieldPromptComponent onlyTrashed()
 * @method static Builder<static>|AirtableAiTextFieldFieldPromptComponent query()
 * @method static Builder<static>|AirtableAiTextFieldFieldPromptComponent whereCreatedAt($value)
 * @method static Builder<static>|AirtableAiTextFieldFieldPromptComponent whereDeletedAt($value)
 * @method static Builder<static>|AirtableAiTextFieldFieldPromptComponent whereId($value)
 * @method static Builder<static>|AirtableAiTextFieldFieldPromptComponent wherePromptComponentId($value)
 * @method static Builder<static>|AirtableAiTextFieldFieldPromptComponent whereReferencedFieldId($value)
 * @method static Builder<static>|AirtableAiTextFieldFieldPromptComponent whereUpdatedAt($value)
 * @method static Builder<static>|AirtableAiTextFieldFieldPromptComponent withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtableAiTextFieldFieldPromptComponent withoutTrashed()
 *
 * @mixin Eloquent
 */
class AirtableAiTextFieldFieldPromptComponent extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'referenced_field_id',
    ];

    public function promptComponent(): BelongsTo
    {
        return $this->belongsTo(AirtableAiTextFieldPromptComponent::class, 'prompt_component_id');
    }

    public function referencedField(): BelongsTo
    {
        return $this->belongsTo(AirtableField::class, 'referenced_field_id');
    }
}
