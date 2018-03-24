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

        if (request('name')) {


            $this->validate(request(), [
                'name'=>'required',
                'email'=>'required|email'
            ]);
            $user->email = request('email');
            $user->name = request('name');
            $user->role = request('role');

            if (strlen(request('password')) > 0) {
                $user->password = bcrypt(request('password'));
            }

            $user->save();

            return redirect()->back()->with('success', 'The user has updated');
        }

        return view('usersedit', array('id' => $user, 'user' => $user));

    }


}
