<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'user_id','product_name','price','quantity','product_type','discount',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
