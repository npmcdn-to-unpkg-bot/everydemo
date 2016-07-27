<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class TestController extends Controller
{
    private $userM;
    protected $redirectTo = '/';
    public function __construct()
    {
        if(!$this->userM) {
            $this->userM = new User();
        }
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }
    public function sign()
    {
        return view('test.sign');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function signin(Request $request)
    {
        $all = $request->all();
        if($this->validator($all)){
            $id = $this->create($all);
        }
        return $id?$id:0;
    }

    public function signup(Request $request)
    {
        $all = $request->all();
        $userName = $all['userNmae'];
        $email = $all['email'];
        $passwd = $all['passwd'];
        $user = $this->userM->where('email',$email)->orWhere('name',$userName)->get();
        if(bcrypt($passwd)==$user->password){
            print_r('pass');
            die;
        }
    }
}
