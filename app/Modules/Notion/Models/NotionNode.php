<?php

namespace App\Modules\Notion\Models;

use App\Modules\Band\Models\BandWiki;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class NotionNode extends Model
{
    protected $fillable = [];

    public function workspace(): HasOne
    {
        return $this->hasOne(NotionWorkspace::class, 'node_id');
    }

    public function database(): HasOne
    {
        return $this->hasOne(NotionDatabase::class, 'node_id');
    }

    public function page(): HasOne
    {
        return $this->hasOne(NotionPage::class, 'node_id');
    }

    public function bandWiki(): HasOne
    {
        return $this->hasOne(BandWiki::class);
    }

    public function databases(): HasMany
    {
        return $this->hasMany(NotionDatabase::class, 'location_id');
    }
}
