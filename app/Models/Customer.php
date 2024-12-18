<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticable;

class Customer extends Authenticable
{
    use HasFactory;

    protected $fillable =
    [
        'name', 'email', 'password'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    /**
     * @return HasMany
     */
    public function invoices() :HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function carts() : HasMany
    {
        return $this->hasMany(Cart::class);
    }

}
