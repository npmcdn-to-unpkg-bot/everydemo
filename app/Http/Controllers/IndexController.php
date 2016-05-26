<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class IndexController extends Controller
{
    //
    public function index()
    {}
    public function headroom()
    {
        return view('headroom.index');
    }
    public function animate()
    {
        return view('animate.index');
    }
}
