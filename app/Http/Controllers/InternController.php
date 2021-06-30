<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InternController extends Controller
{

    public function show(Request $request)
    {

        return view('profile.info', [
            'request' => $request,
            'user' => $request->user(),
        ]);
    }

    public function accepted(Request $request)
    {
        return view('intern.accepted', [
            'request' => $request,
            'user' => $request->user(),
        ]);
    }

    public function submissions(Request $request)
    {
        return view('intern.submission', [
            'request' => $request,
            'user' => $request->user(),
        ]);
    }

    public function rejected(Request $request){
        return view('intern.rejected', [
            'request' => $request,
            'user' => $request->user(),
        ]);
    }
}
