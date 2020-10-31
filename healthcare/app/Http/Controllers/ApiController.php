<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    function getUserById(Request $req , $id)
    {
        return response()->json(User::where("id" , $id)->get());
    }


    public function updateUser(Request $req)
    {
        $json_test = "ok json";

        return response()->json($json_test);
    }
}
