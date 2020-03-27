<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public function is_admin() {
        return $this->id === 1;
    }

    public function carts() {
        return $this->hasMany('App\cart');
    }

    public function histories() {
        return $this->hasMany('App\history');
    }

    public function carts_sum() {
        return $this->carts->sum(function($cart) {
            return $cart->cart_sum();
        });
        // return $this->carts->reduce(function($carry, $cart){
        //         return $carry + $cart->cart_sum();
        //     });という書き方もある
    }
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

    
}
