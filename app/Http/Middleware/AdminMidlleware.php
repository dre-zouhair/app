<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMidlleware
{
    /**
     * Handle an incoming request.
     * If the authenticated user is not an admin we redirect the request
     * If not, we continue the execution by passing the request to the next (Middleware or at the end a controller)
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(User::all()->find(Auth::user()->getAuthIdentifier())->user_type  == "admin"){
            return $next($request);
        }
        return redirect()->back();
    }
}
