<?php

namespace App\Http\Controllers;

use App\Enums\PaypalSubscriptionStatusEnum;
use App\Models\Group;
use App\Models\Product;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{   

    public function __construct()
    {
        
    }


    public function initiateSubscription(Request $request)
    {        
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',            
        ]);

        $customer = null;
        if(!$customer = User::where('email', $request->email)->first()){
            $customer = User::make([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
            ]);
            $customer->password = bcrypt(str()->random(10));
            $customer->syncRoles('customer');
        }

        // check if there is any group
        // where we can add new members
        // and where $customer isn't already member of
        $groups = $customer->groups;
 
        $groupExists = Group::canAddMembers()
                                ->whereNotIn('id', $groups->pluck('id'))
                                ->exists();
        if(!$groupExists){
            return "There is no group where you can join at the moment";
        }



        $product = Product::first(); 

        $provider = new \Srmklive\PayPal\Services\PayPal(config('paypal'));
        $provider->getAccessToken();
 
        $data = json_decode('{
            "plan_id": "'.$product->paypal_plan_id.'",
            "quantity": "1",
            "subscriber": {
            "name": {
                "given_name": "'. $request->first_name .'",
                "surname": "'. $request->last_name .'"
            },
            "email_address": "'. $request->email .'"
            },
            "application_context": {
                "brand_name": "Fbacity",
                "locale": "en-US",
                "shipping_preference": "NO_SHIPPING",
                "user_action": "SUBSCRIBE_NOW",
                "return_url": "'. route('subscription.success') .'",
                "cancel_url": "'. route('subscription.failed') .'"
            }
        }', true);

        try{
            $subscription = $provider->createSubscription($data);
            $customer->temp_subscription_id = $subscription['id'];
            $customer->save();

            return redirect($subscription['links'][0]['href']);    
        }catch(\Exception $e){
            return "There is some problem creating a subscription please try again later";
        }

    }


    /**
     * 
     * (Paypal Return URL) if the subscription succeed
     */
    public function success(Request $request): string|View 
    {
        /**
         * check if any customer started the subscription
         */

        $customer = User::where('temp_subscription_id', $request->subscription_id)
                        ->first();
        if(!$customer){
            return redirect()->route('dashboard');
        }


        /**
         * Fetch subscription from paypal
         */
        $subscription = null;
        try{
            $provider = new \Srmklive\PayPal\Services\PayPal(config('paypal'));
            $provider->getAccessToken();
            $subscription = $provider->showSubscriptionDetails($request->subscription_id);
        }catch(\Exception $e){
            return abort(404, 'Subscription not found');
        }

        if(!$subscription || !isset($subscription['billing_info']))
            return abort(404, 'Subscription not found');


        /**
         * check if the subscription is active
         */
        if(!PaypalSubscriptionStatusEnum::from($subscription['status'])->isActive()){
            return abort(404, 'Subscription not active');
        }


        // find group
        // where we can add new members
        // and where $customer isn't already member of
        $group = Group::canAddMembers()
                        ->whereDoesntHave('users', function($q) use($customer){
                            $q->where('user_id', $customer->id);
                        })->first();


        /**
         * Create a new subscription
         */
        $product = Product::where('paypal_plan_id', $subscription['plan_id'])->first();        

        $sub = Subscription::create([
            'next_billing_date' => Carbon::parse($subscription['billing_info']['next_billing_time']),
            'start_date' => Carbon::parse($subscription['start_time']),
    
            'status' => $subscription['status'],
            'paypal_subscription_id' => $subscription['id'],
            'paypal_plan_id' => $product->paypal_plan_id,
            'price' => $product->price,
        ]);

        $sub->product()->associate($product);
        $sub->group()->associate($group);
        $sub->user()->associate($customer);
        $sub->save();

        Auth::login($customer);


        
        // add the user to the group
        $customer->groups()->attach($group->id);
        $customer->save();


        // reset the temp_subscription_id
        $customer->temp_subscription_id = null;
        $customer->save();
        
        return view('subscription.success')
                    ->with('subscription', $sub)
                    ->with('customer', $customer);
    }


    /**
     * 
     * (Paypal Return URL) if the subscription failed
     */
    public function failed(Request $request): string|View
    {
        $provider = new \Srmklive\PayPal\Services\PayPal(config('paypal'));
        $provider->getAccessToken();
        $subscription = $provider->showSubscriptionDetails($request->subscription_id);

        User::where('temp_subscription_id', $request->subscription_id)->update([
            'temp_subscription_id' => null,
        ]);


        return view('subscription.failed')
                    ->with('subscription', $subscription);
    }



}
