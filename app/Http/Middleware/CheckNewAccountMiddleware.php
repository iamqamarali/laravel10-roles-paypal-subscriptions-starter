<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckNewAccountMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        if(!$user){
            return redirect()->route('login');
        }

        if(!$user->hasRole('customer')){
            return $next($request);
        }


        // if user haven't changed it's password yet
        if($user->should_change_password){
            return redirect()->route('newsubscriber.change-password-view');
        }

        // if($user->should_select_groups){
        //     return redirect()->route('newsubscriber.choose-groups-view');
        // }

        return $next($request);
    }
}
