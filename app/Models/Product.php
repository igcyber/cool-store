<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'title',
        'slug',
        'category_id',
        'sub_category_id',
        'content',
        'weight',
        'price',
        'discount'
    ];


    /**
     * Accessor Image
     * @return Attribute
     */
    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn($value) => url('/storage/products/'. $value)
        );
    }

    /**
     * @return BelongsTo
     */
    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return BelongsTo
     */
    public function subCategory() : BelongsTo
    {
        return $this->belongsTo(SubCategory::class);
    }

    /**
     * @return HasMany
     */
    public function carts() : HasMany
    {
        return $this->hasMany(Cart::class);
    }
}
