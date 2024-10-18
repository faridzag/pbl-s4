<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class User extends Authenticatable implements MustVerifyEmail, CanResetPasswordContract
{
    use HasFactory, Notifiable, CanResetPassword;

    const ROLE_JPC = 'JPC';
    const ROLE_COMPANY = 'COMPANY';
    const ROLE_APPLICANT = 'APPLICANT';
    const ROLE_DEFAULT = self::ROLE_APPLICANT;

    const ROLES = [
        self::ROLE_JPC => 'JPC',
        self::ROLE_COMPANY => 'COMPANY',
        self::ROLE_APPLICANT => 'APPLICANT',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'name',
        'avatar',
        'email',
        'role',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_JPC;
    }

    public function isCompany(): bool
    {
        return $this->role === self::ROLE_COMPANY;
    }

    public function isApplicant(): bool
    {
        return $this->role === self::ROLE_APPLICANT;
    }

    public function company()
    {
        return $this->hasOne(Company::class);
    }

    public function vacancy()
    {
        return $this->hasOne(Vacancy::class);
    }

    public function applicant()
    {
        return $this->hasOne(Applicant::class);
    }
}
