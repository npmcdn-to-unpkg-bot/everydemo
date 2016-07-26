<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;

class TestController extends Controller
{
    private $userM;
    public function __construct()
    {
        if(!$this->userM) {
            $this->userM = new User();
        }
    }
    public function sign()
    {
        return view('test.sign');
    }

    public function signin(Request $request)
    {
        $all = $request->all();
    }
    public function signup(Request $request)
    {
        $all = $request->all();
    }
}
