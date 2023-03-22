<?php

namespace App\Http\Middleware;

use App\Enums\PaypalSubscriptionStatusEnum;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSubscriptionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        if(!$user)
            return redirect()->route('login');

        if(!$user->hasRole('customer')){
            return $next($request);
        }
    
        if($user->haveActiveSubscription())
            return $next($request);


        return abort(403, 'You do not have an active subscription');
    }

}
