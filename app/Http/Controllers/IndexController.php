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

    public function threejs()
    {
        return view('threejs.index');
    }

    public function canvas()
    {
        return view('canvas.index');
    }

    public function resumable()
    {
        return view('resumable.index');
    }

    public function videojs()
    {
        return view('videojs.index');
    }

    public function howler()
    {
        return view('howler.index');
    }
    public function brush()
    {
        return view('webvr.brush');
    }

}
