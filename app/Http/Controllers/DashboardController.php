<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        // toast('Your Post as been submited!', 'success');
        return view('dashboard');
    }
}