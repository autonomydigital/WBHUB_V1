<?php


namespace Modules\Businesses\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $fillable = [
        'name', 'description', 'logo', 'cover_photo',
        'street', 'suburb', 'state', 'postcode', 'country',
        'created_by',
    ];

    public function owner()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }

    public function users()
    {
        return $this->belongsToMany(\App\Models\User::class)->withPivot('role')->withTimestamps();
    }
}