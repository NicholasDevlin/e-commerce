<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'amount'
    ];

    public function users(){
        return $this->belongsTo(User::class);
    }

    public function products() {
        return $this->belongsTo(Product::class);
    }
}
