<?php

namespace Modules\WebsiteContent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class WebsitePage extends Model
{
    protected $table = 'website_pages';

    protected $fillable = [
        'business_id',
        'page_slug',
        'status',
        'visibility',
        'publish_at',
    ];

    protected $casts = [
        'publish_at' => 'datetime',
    ];

    /**
     * Get all sections for the page.
     */
    public function sections(): HasMany
    {
        return $this->hasMany(WebsitePageSection::class, 'page_id')->orderBy('order');
    }

    /**
     * Get all images for the page, via sections.
     */
    public function images(): HasManyThrough
    {
        return $this->hasManyThrough(
            WebsitePageImage::class,
            WebsitePageSection::class,
            'page_id',      // Foreign key on WebsitePageSection
            'section_id',   // Foreign key on WebsitePageImage
            'id',           // Local key on WebsitePage
            'id'            // Local key on WebsitePageSection
        )->orderBy('order');
    }
}