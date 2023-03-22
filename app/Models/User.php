<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'name',
        'email',

        'temp_subscription_id',
        'should_choose_groups',
        'should_change_password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'roles', // super-admin|admin|editor|customer|
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
        'data' => 'json'
    ];


    protected static function boot()
    {
        parent::boot();

        static::creating(function($user){            
            $user->should_change_password = true;
        });

        static::saving(function ($user) {
            $user->name = $user->first_name . ' ' . $user->last_name;
        });
    }



    /**
     * relations
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class,);
    }


    /**
     * scopes
     */



    /**
     * methods
     */
    public function haveActiveSubscription(){
        return $this->subscriptions()->active()->exists();
    }


}
