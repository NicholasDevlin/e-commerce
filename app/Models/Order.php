<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'is_paid',
        'payment_receipt'
    ];

    public function users() {
        return $this->belongsTo(User::class);
    }

    public function products() {
        return $this->belongsToMany(Product::class);
    }
}
