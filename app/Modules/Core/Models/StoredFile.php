<?php

namespace App\Modules\Core\Models;

use App\Modules\Notion\Models\NotionDatabase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class StoredFile extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'type',
        'name',
        'path',
    ];

    public function icon(): HasMany
    {
        return $this->hasMany(NotionDatabase::class, 'icon_id');
    }
}
