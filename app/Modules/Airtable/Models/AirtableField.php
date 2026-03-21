<?php

namespace App\Modules\Airtable\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int|null $table_id
 * @property int $rank
 * @property string|null $external_id
 * @property string $name
 * @property string|null $description
 * @property string $type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read AirtableAiTextField|null $aiTextField
 * @property-read Collection<int, AirtableAiTextFieldFieldPromptComponent> $aiTextFieldFieldPromptComponents
 * @property-read int|null $ai_text_field_field_prompt_components_count
 * @property-read AirtableAttachmentsField|null $attachmentsField
 * @property-read AirtableAutoNumberField|null $autoNumberField
 * @property-read AirtableBarcodeField|null $barcodeField
 * @property-read AirtableButtonField|null $buttonField
 * @property-read AirtableCheckboxField|null $checkboxField
 * @property-read AirtableCollaboratorField|null $collaboratorField
 * @property-read AirtableCollaboratorsField|null $collaboratorsField
 * @property-read AirtableCountField|null $countField
 * @property-read AirtableCreatedAtField|null $createdAtField
 * @property-read AirtableCreatedByField|null $createdByField
 * @property-read AirtableCurrencyField|null $currencyField
 * @property-read AirtableDateAndTimeField|null $dateAndTimeField
 * @property-read AirtableDateField|null $dateField
 * @property-read AirtableDurationField|null $durationField
 * @property-read AirtableEmailAddressField|null $emailAddressField
 * @property-read AirtableFormulaField|null $formulaField
 * @property-read AirtableLongTextField|null $longTextField
 * @property-read AirtableLookupField|null $lookupField
 * @property-read AirtableNumberField|null $numberField
 * @property-read AirtablePercentageField|null $percentageField
 * @property-read AirtablePhoneNumberField|null $phoneNumberField
 * @property-read AirtableRatingField|null $ratingField
 * @property-read AirtableRecordLinksField|null $recordLinksField
 * @property-read AirtableRichTextField|null $richTextField
 * @property-read AirtableRollupField|null $rollupField
 * @property-read AirtableSelectionField|null $selectionField
 * @property-read AirtableSelectionsField|null $selectionsField
 * @property-read AirtableShortTextField|null $shortTextField
 * @property-read AirtableSyncSourceField|null $syncSourceField
 * @property-read AirtableTable|null $table
 * @property-read AirtableUpdatedAtField|null $updatedAtField
 * @property-read Collection<int, AirtableUpdatedAtFieldField> $updatedAtFieldField
 * @property-read int|null $updated_at_field_field_count
 * @property-read AirtableUpdatedByField|null $updatedByField
 * @property-read AirtableUrlField|null $urlField
 *
 * @method static Builder<static>|AirtableField newModelQuery()
 * @method static Builder<static>|AirtableField newQuery()
 * @method static Builder<static>|AirtableField onlyTrashed()
 * @method static Builder<static>|AirtableField query()
 * @method static Builder<static>|AirtableField whereCreatedAt($value)
 * @method static Builder<static>|AirtableField whereDeletedAt($value)
 * @method static Builder<static>|AirtableField whereDescription($value)
 * @method static Builder<static>|AirtableField whereExternalId($value)
 * @method static Builder<static>|AirtableField whereId($value)
 * @method static Builder<static>|AirtableField whereName($value)
 * @method static Builder<static>|AirtableField whereRank($value)
 * @method static Builder<static>|AirtableField whereTableId($value)
 * @method static Builder<static>|AirtableField whereType($value)
 * @method static Builder<static>|AirtableField whereUpdatedAt($value)
 * @method static Builder<static>|AirtableField withTrashed(bool $withTrashed = true)
 * @method static Builder<static>|AirtableField withoutTrashed()
 *
 * @mixin Eloquent
 */
class AirtableField extends Model
{
    use CascadeSoftDeletes, SoftDeletes;

    protected $fillable = [
        'rank',
        'external_id',
        'name',
        'description',
        'type',
    ];

    protected array $cascadeDeletes = [
        'aiTextField',
        'attachmentsField',
        'autoNumberField',
        'barcodeField',
        'buttonField',
        'checkboxField',
        'collaboratorField',
        'collaboratorsField',
        'countField',
        'createdAtField',
        'createdByField',
        'currencyField',
        'dateField',
        'dateAndTimeField',
        'durationField',
        'emailAddressField',
        'formulaField',
        'longTextField',
        'lookupField',
        'numberField',
        'percentageField',
        'phoneNumberField',
        'ratingField',
        'recordLinksField',
        'richTextField',
        'rollupField',
        'selectionField',
        'selectionsField',
        'shortTextField',
        'syncSourceField',
        'updatedAtField',
        'updatedByField',
        'urlField',
    ];

    public function table(): BelongsTo
    {
        return $this->belongsTo(AirtableTable::class, 'table_id');
    }

    public function aiTextField(): HasOne
    {
        return $this->hasOne(AirtableAiTextField::class, 'field_id');
    }

    public function attachmentsField(): HasOne
    {
        return $this->hasOne(AirtableAttachmentsField::class, 'field_id');
    }

    public function autoNumberField(): HasOne
    {
        return $this->hasOne(AirtableAutoNumberField::class, 'field_id');
    }

    public function barcodeField(): HasOne
    {
        return $this->hasOne(AirtableBarcodeField::class, 'field_id');
    }

    public function buttonField(): HasOne
    {
        return $this->hasOne(AirtableButtonField::class, 'field_id');
    }

    public function checkboxField(): HasOne
    {
        return $this->hasOne(AirtableCheckboxField::class, 'field_id');
    }

    public function collaboratorField(): HasOne
    {
        return $this->hasOne(AirtableCollaboratorField::class, 'field_id');
    }

    public function collaboratorsField(): HasOne
    {
        return $this->hasOne(AirtableCollaboratorsField::class, 'field_id');
    }

    public function countField(): HasOne
    {
        return $this->hasOne(AirtableCountField::class, 'field_id');
    }

    public function createdAtField(): HasOne
    {
        return $this->hasOne(AirtableCreatedAtField::class, 'field_id');
    }

    public function createdByField(): HasOne
    {
        return $this->hasOne(AirtableCreatedByField::class, 'field_id');
    }

    public function currencyField(): HasOne
    {
        return $this->hasOne(AirtableCurrencyField::class, 'field_id');
    }

    public function dateField(): HasOne
    {
        return $this->hasOne(AirtableDateField::class, 'field_id');
    }

    public function dateAndTimeField(): HasOne
    {
        return $this->hasOne(AirtableDateAndTimeField::class, 'field_id');
    }

    public function durationField(): HasOne
    {
        return $this->hasOne(AirtableDurationField::class, 'field_id');
    }

    public function emailAddressField(): HasOne
    {
        return $this->hasOne(AirtableEmailAddressField::class, 'field_id');
    }

    public function formulaField(): HasOne
    {
        return $this->hasOne(AirtableFormulaField::class, 'field_id');
    }

    public function longTextField(): HasOne
    {
        return $this->hasOne(AirtableLongTextField::class, 'field_id');
    }

    public function lookupField(): HasOne
    {
        return $this->hasOne(AirtableLookupField::class, 'field_id');
    }

    public function numberField(): HasOne
    {
        return $this->hasOne(AirtableNumberField::class, 'field_id');
    }

    public function percentageField(): HasOne
    {
        return $this->hasOne(AirtablePercentageField::class, 'field_id');
    }

    public function phoneNumberField(): HasOne
    {
        return $this->hasOne(AirtablePhoneNumberField::class, 'field_id');
    }

    public function ratingField(): HasOne
    {
        return $this->hasOne(AirtableRatingField::class, 'field_id');
    }

    public function recordLinksField(): HasOne
    {
        return $this->hasOne(AirtableRecordLinksField::class, 'field_id');
    }

    public function richTextField(): HasOne
    {
        return $this->hasOne(AirtableRichTextField::class, 'field_id');
    }

    public function rollupField(): HasOne
    {
        return $this->hasOne(AirtableRollupField::class, 'field_id');
    }

    public function selectionField(): HasOne
    {
        return $this->hasOne(AirtableSelectionField::class, 'field_id');
    }

    public function selectionsField(): HasOne
    {
        return $this->hasOne(AirtableSelectionsField::class, 'field_id');
    }

    public function shortTextField(): HasOne
    {
        return $this->hasOne(AirtableShortTextField::class, 'field_id');
    }

    public function syncSourceField(): HasOne
    {
        return $this->hasOne(AirtableSyncSourceField::class, 'field_id');
    }

    public function updatedAtField(): HasOne
    {
        return $this->hasOne(AirtableUpdatedAtField::class, 'field_id');
    }

    public function updatedByField(): HasOne
    {
        return $this->hasOne(AirtableUpdatedByField::class, 'field_id');
    }

    public function urlField(): HasOne
    {
        return $this->hasOne(AirtableUrlField::class, 'field_id');
    }
}
