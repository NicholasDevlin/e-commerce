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
        'description',
        'image',
        'stock'
    ];

    public function order() {
        return $this->belongsToMany(Order::class);
    }

    public function cart() {
        return $this->hasMany(Cart::class);
    }
}
