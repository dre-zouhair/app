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
     *
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
