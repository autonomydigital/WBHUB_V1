<?php 

namespace Modules\WebsiteContent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NewsPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'image',
        'published',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function business()
    {
        return $this->belongsTo(\App\Models\Business::class);
    }
}