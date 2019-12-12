<?php

namespace App\Domain\Users\Models;

use App\Domain\Accounts\Models\Account;
use App\Domain\Addresses\Models\Address;
use Illuminate\Notifications\Notifiable;
use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, GeneratesUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function uuid(string $uuid): self
    {
        return static::where('uuid', $uuid)->first();
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    public function accounts()
    {
        return $this->belongsToMany(Account::class);
    }

    public function addresses()
    {
        return $this->belongsToMany(Address::class);
    }
}
