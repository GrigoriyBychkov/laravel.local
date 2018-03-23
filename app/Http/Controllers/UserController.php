<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Controllers;
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
        var_dump($request->input('name'));
//        $this->validate(request(), [
//                'name'=>'required',
//                'email'=>'required|email|unique:users',
//                'password'=>'required|min:6|confirmed'
//            ]);
//
        if (request('email')) {
            $user->email = request('email');
            $user->save();
        }
//        $user->name = request('name');

//        $user->password = bcrypt(request('password'));
//


        return view('usersedit', array('id' => $user, 'user' => $user));

    }


}
