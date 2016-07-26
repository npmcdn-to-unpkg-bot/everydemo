<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class RbacController extends Controller
{
    public function allow($id,$action)
    {
        $user_id = $id;
        //todo check $user_id and $action bindMap's permission
    }
}
