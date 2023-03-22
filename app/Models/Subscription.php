<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\PaypalSubscriptionStatusEnum;

class Subscription extends Model
{
    use HasFactory;


    protected $fillable = [
        'status', 
        'paypal_subscription_id',
        'paypal_plan_id',

        'next_billing_date',
        'start_date',
        'price',
        'is_new',

        'user_id',
        'product_id',
        'group_id',
    ];

    protected $casts = [
        'price' => 'float',
        'status'=> PaypalSubscriptionStatusEnum::class,

        'next_billing_date' => 'datetime',
        'start_date' => 'datetime',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function product()
    {
        return $this->belongsTo(Product::class);
    }


    /**
     * 
     * scope for active subscriptions
     */
    public function scopeActive($query)
    {
        return $query->where('status',\App\Enums\PaypalSubscriptionStatusEnum::ACTIVE);
    }


}
