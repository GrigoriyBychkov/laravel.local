<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
//    public function show($id){
//        return view('user.profile', ['user' => User::findOrFail($id)]);
//    }
    public function index(){
        $users = User::all();
        return view('users', array('users' => $users));
    }

    public function edit(Request $request, $id){
        $user = User::find($id);
        return view('usersedit', array('id' => $user));
    }
}
