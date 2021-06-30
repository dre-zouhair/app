<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{

    // this methode is used to return a view with some injected data, that will be accessible from the view
    public function ListEnterprises(Request $request)
    {
        return view('admin.index', [
            'request' => $request,
            'user' => $request->user(),
        ]);
    }

}
