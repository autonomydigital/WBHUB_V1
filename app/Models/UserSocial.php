<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSocial extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'platform', 'handle','color','icon'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
