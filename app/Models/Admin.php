<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, HasUuid;
    protected $table = 'admins';
    protected $fillable = [
        'full_name',
        'email_address',
        'email',
        'phone',
        'password',
        'last_login',
        'active',
    ];

    protected $dates = ['last_login'];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function getStatusAttribute()
    {
        return $this->active ? "فعال" : "غير فعال";
    }
}
