<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'logo',
        'cover_photo',
        'subdomain',
        'custom_domain',
        'street',
        'suburb',
        'state',
        'postcode',
        'country',
        'created_by',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('role')->withTimestamps();
    }
}