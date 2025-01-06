<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'image', 'category_id'
    ];


     /**
     * Accessor image
     * @return Attribute
     */
    protected function image() : Attribute
    {
        return Attribute::make(
            get: fn($value) => url('/storage/subcategories/' . $value)
        );
    }


    /**
     * @return HasMany
     */
    public function products() :HasMany
    {
        return $this->hasMany(Product::class);
    }


    /**
     * @return BelongsTo
     */
    public function category() :BelongsTo
    {
        return $this->belongsTo(Category::class);
    }


}
