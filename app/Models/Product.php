<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{

    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
        'store_id',
        'image',
        'qty',
        'box_price',
        'box_qty',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function sale(): HasMany
    {
        return $this->hasMany(Sale::class);
    }

    public function invoice(): BelongsToMany
    {
        return $this->belongsToMany(Invoice::class);
    }
}
