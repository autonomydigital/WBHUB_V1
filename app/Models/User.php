<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Str;

/**
 * @method void notify(\Illuminate\Notifications\Notification $notification)
 * @method void markEmailVerified()
 */

class User extends Authenticatable
{
    use HasRoles, HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'first_name','last_name','email','bio', 'suburb', 'state', 'postcode','password','avatar','cover_photo','verification_code','code_expires_at','two_factor_enabled',
    'secondary_verification_enabled',
    ];

    protected $hidden = [
        'password','remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'code_expires_at'   => 'datetime',
    ];

    /**
 * @method void notify(\Illuminate\Notifications\Notification $notification)
 * @method void markEmailVerified()
 */

    /**
     * Generate and persist a 4‑digit OTP (valid 15 minutes).
     */
    public function generateVerificationCode(): int
{
    $code = rand(1000,9999);
    $this->update([
        'verification_code' => $code,
        'code_expires_at'   => now()->addMinutes(15),
    ]);
    return $code;
}

public function markEmailVerified(): void
{
    $this->update([
        'email_verified_at' => now(),
        'verification_code' => null,
        'code_expires_at'   => null,
    ]);
}

public function profileCompletionPercent()
{
    $fields = [
        'first_name',
        'last_name',
        'email',
        'avatar',
        'cover_photo',
        'phone',
        'bio',
        'suburb',
        'state',
        'postcode'
    ];

    $filled = collect($fields)->filter(fn($field) => !empty($this->$field));

    $percent = round(($filled->count() / count($fields)) * 100);

    return $percent;
}

public function socials()
{
    return $this->hasMany(UserSocial::class);
}

public function loginHistories()
{
    return $this->hasMany(\App\Models\LoginHistory::class);
}

public function backupCodes()
{
    return $this->hasMany(BackupCode::class);
}

public function following()
{
    return $this->belongsToMany(User::class, 'user_follows', 'follower_id', 'followed_id')->withTimestamps();
}

public function followers()
{
    return $this->belongsToMany(User::class, 'user_follows', 'followed_id', 'follower_id')->withTimestamps();
}

public function isFollowing(User $user): bool
{
    return $this->following->contains($user->id);
}

public function sentConnections()
{
    return $this->hasMany(UserConnection::class, 'user_id');
}

public function receivedConnections()
{
    return $this->hasMany(UserConnection::class, 'connected_user_id');
}

public function connections()
{
    return $this->belongsToMany(User::class, 'user_connections', 'user_id', 'connected_user_id')
        ->wherePivot('status', 'accepted')
        ->withTimestamps();
}

public function isConnectedWith(User $user)
{
    return $this->allConnectionsRaw()
        ->where('connected_user_id', $user->id)
        ->wherePivot('status', 'accepted')
        ->exists();
}

public function regionStatus(): string
{
    $localSuburbs = [
        'Bowen', 'Airlie Beach', 'Cannonvale', 'Proserpine', 'Shute Harbour',
        'Collinsville', 'Hydeaway Bay', 'Dingo Beach', 'Mount Julian', 'Woodwark', 'Whitsundays'
    ];

    return in_array(Str::lower($this->suburb), array_map('strtolower', $localSuburbs)) ? 'local' : 'visitor';
}

public function allConnectionsRaw()
{
    return $this->belongsToMany(User::class, 'user_connections', 'user_id', 'connected_user_id')
        ->withPivot('status')
        ->withTimestamps();
}

public function hasPendingConnectionWith($user)
{
    return $this->allConnectionsRaw()
        ->where('connected_user_id', $user->id)
        ->wherePivot('status', 'pending')
        ->exists();
}

public function hasIncomingConnectionRequestFrom(User $user)
{
    return $this->receivedConnections()
        ->where('user_id', $user->id)
        ->where('status', 'pending')
        ->exists();
}

public function hasSentConnectionRequestTo($user)
{
    return $user->receivedConnections()
        ->where('user_id', $this->id)
        ->where('status', 'pending')
        ->exists();
}


}