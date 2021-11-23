<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static $rules =
        [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ];

    public static $messages = [
        'name.required' => "User name is required.",
        'email.required' => "User email is required.",
        'email.email' => "User email must be a valid email address.",
        'password.required' => "User password is required.",
    ];

    public function setPasswordAttribute($password) : void
    {
        $hash = Hash::make($password);
        $this->attributes['password'] = $hash;
    }
}
