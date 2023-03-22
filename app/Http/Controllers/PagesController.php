<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:customer');
        // $this->middleware('check-subscription');
        // $this->middleware('check-new-account');
    }

    public function dashboard()
    {
        return view('customers.dashboard');
    }
    

}
