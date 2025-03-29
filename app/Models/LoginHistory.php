<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginHistory extends Model
{
    protected $fillable = ['user_id',
    'device',
    'ip_address',
    'city',
    'region',
    'country',
    'logged_in_at',];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
