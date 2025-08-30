<?php

namespace Modules\WebsiteContent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WebsitePageImage extends Model
{
    protected $table = 'website_page_images';

    protected $fillable = [
        'section_id',
        'image_path',
        'alt_text',
        'caption',
        'order',
    ];

    /**
     * Get the section this image belongs to.
     */
    public function section(): BelongsTo
    {
        return $this->belongsTo(WebsitePageSection::class, 'section_id');
    }
}