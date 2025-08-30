<?php

namespace Modules\WebsiteContent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_id',
        'agent_id',
        'title',
        'slug',
        'address',
        'category',
        'listing_type',
        'price',
        'bedrooms',
        'bathrooms',
        'area',
        'latitude',
        'longitude',
        'image_count',
        'description',
    ];
}