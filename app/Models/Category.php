<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;


    protected $fillable = [
        'name', 'slug', 'image'
    ];

    /**
     * Accessor image
     * @return Attribute
     */
    protected function image() : Attribute
    {
        return Attribute::make(
            get: fn($value) => url('/storage/categories/' . $value)
        );
    }

    /**
     * @return HasMany
     */
    public function products() :HasMany
    {
        return $this->hasMany(Product::class);
    }
}
