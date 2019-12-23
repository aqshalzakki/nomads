<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('user.checkout.index');
    }

    public function success()
    {
        return view('user.checkout.success');
    }
}
