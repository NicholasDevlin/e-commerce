<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\HasOne;
use Illuminate\Database\Eloquent\BelongsTo;

class Transaction extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'amount'
    ];

    public function order() {
        return $this->hasOne(Order::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
