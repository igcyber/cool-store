<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'invoice',
        'customer_id',
        'courier',
        'service',
        'cost_courier',
        'weight',
        'name',
        'phone',
        'province',
        'city',
        'address',
        'status',
        'snap_token',
        'grand_total'
    ];

    /**
     * @return HasMany
     */
    public function orders() : HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * @return BelongsTo
     */
    public function customer() :BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
