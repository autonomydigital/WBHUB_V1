<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserEasterEgg extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'egg_key',
    ];

    // Optional: define relationship to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}