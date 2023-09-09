<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isPremiumUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!is_null($user) && ($user->user_trial > date('Y-m-d') || $user->billing_ends > date('Y-m-d'))) {
            return $next($request);
            // Allow the request to continue
        }
        return redirect()->route('subscribe')->with('message', 'Please subscribe to post a job');
        // Redirect the user to the subscription page with a message
    }
}
