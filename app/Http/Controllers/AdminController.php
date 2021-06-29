<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function ListEnterprises(Request $request)
    {
        return view('admin.index', [
            'request' => $request,
            'user' => $request->user(),
        ]);
    }

}
