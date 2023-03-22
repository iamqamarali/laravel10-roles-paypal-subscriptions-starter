<?php

namespace App\Listeners;

use App\Enums\PaypalSubscriptionStatusEnum;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserLoginListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $user = $event->user;

        if(!$user->hasRole('customer')){
            return;
        }

        /**
         * 
         * Check if all the db active subscriptions
         * are still active on paypal too
         * and sync the status with db
         */
        $provider = new \Srmklive\PayPal\Services\PayPal(config('paypal'));
        $provider->getAccessToken();

        foreach($user->subscriptions()->active()->get() as $sub){

            // if the subscription expiry is in future then skip it
            if($sub->next_billing_date->isFuture()){
                continue;
            }

            $response = $provider->showSubscriptionDetails($sub->paypal_subscription_id);
            if(!PaypalSubscriptionStatusEnum::from($response['status'])->isActive()){
                $sub->status = $response['status'];
                $sub->save();

                $user->groups()->detach($sub->group_id);
            }else{
                $sub->next_billing_date = Carbon::parse($response['billing_info']['next_billing_time']);
                $sub->save();
            }
        }

        

    }
}
