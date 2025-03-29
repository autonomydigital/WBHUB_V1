<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

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

}