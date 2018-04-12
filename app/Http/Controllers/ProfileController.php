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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        return view('profile', array('user' => $user));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function profileUpdate(Request $request)
    {
        $user = Auth::user();
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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function showChangePasswordForm()
    {
        return view('auth.changepassword');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePassword(Request $request)
    {
        $user = Auth::user();
        $newPasswordHash = bcrypt(request('password'));
        $user->password = $newPasswordHash;
        $this->validate(request(), [
            'password' => 'required',
        ]);

        $user->save();
        return redirect()->back()->with('success', 'password updated');
    }
}