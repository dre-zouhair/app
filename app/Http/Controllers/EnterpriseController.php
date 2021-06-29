<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EnterpriseController extends Controller
{
    public function ListInternships(Request $request)
    {
        return view('enterprise.index', [
            'request' => $request,
            'user' => $request->user(),
        ]);
    }

    public function ListSubmissions(Request $request)
    {
        return view('enterprise.submissions', [
            'request' => $request,
            'user' => $request->user(),
        ]);
    }

}
