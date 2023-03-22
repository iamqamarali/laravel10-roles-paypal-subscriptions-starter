<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',

        'paypal_product_id',
        'paypal_plan_id',
    ];
    

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
    

}
