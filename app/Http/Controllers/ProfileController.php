<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Controllers;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;



class ProfileController extends Controller
{
    use RegistersUsers;

    public function index(){
        $user = Auth::user();
        return view('profile', array('user' => $user));
    }

    public function profileUpdate(Request $request)
    {
        $user = Auth::user();
        var_dump($user->name);
        var_dump($user->email);
        if (request('name') || request('email')) {
            $this->validate(request(), [
                'name' => 'required',
                'email' => 'required|email'
            ]);
            $user->name = request('name');
            $user->email = request('email');

            $user->save();

            return redirect()->back()->with('success', 'The user has updated');

        }
        return view('profile', array('user' => $user));
    }


    public function showChangePasswordForm(){
        return view('auth.changepassword');
    }

    public function changePassword(Request $request){
        $user = Auth::user();
//        $currentPasswordHash = $user->password;
        $newPasswordHash = bcrypt(request('password'));
//        if($currentPasswordHash=$newPasswordHash){
//
//        }
        $user->password = $newPasswordHash;
        $this->validate(request(), [
            'password'=>'required',
        ]);

        $user->save();
        return redirect()->back()->with('success', 'password updated');
    }
}