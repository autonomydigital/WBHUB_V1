<?php

namespace Modules\WebsiteContent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WebsitePageSection extends Model
{
    protected $table = 'website_page_sections';

    protected $fillable = [
        'page_id',
        'title',
        'content',
        'order',
    ];

    /**
     * Get the page this section belongs to.
     */
    public function page(): BelongsTo
    {
        return $this->belongsTo(WebsitePage::class, 'page_id');
    }

    /**
     * Get all images attached to this section.
     */
    public function images(): HasMany
    {
        return $this->hasMany(WebsitePageImage::class, 'section_id')->orderBy('order');
    }
}