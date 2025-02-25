<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
        'desctiption',
        'image',
        'stock'
    ];

    public function orders() {
        return $this->belongsToMany(Order::class);
    }

    public function carts() {
        return $this->hasMany(Cart::class);
    }
}
