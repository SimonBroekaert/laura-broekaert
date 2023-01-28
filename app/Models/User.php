<?php

namespace App\Models;

use App\Enums\UserType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'type' => UserType::class,
    ];

    /**
     * Scope: Admins
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAdmins(Builder $query): Builder
    {
        return $query->where('type', UserType::TYPE_ADMIN);
    }

    /**
     * Scope: Developers
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDevelopers(Builder $query): Builder
    {
        return $query->where('type', UserType::TYPE_DEVELOPER);
    }

    /**
     * Attribute: is_admin
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function isAdmin(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->type === UserType::TYPE_ADMIN,
        );
    }

    /**
     * Attribute: is_developer
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function isDeveloper(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->type === UserType::TYPE_DEVELOPER,
        );
    }
}
