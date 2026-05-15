<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MomentController extends Controller
{
    public function index()
        {
            return view('page.moment');
        }
}
