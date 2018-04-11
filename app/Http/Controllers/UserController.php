<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Controllers;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;


class UserController extends Controller
{
    use RegistersUsers;

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = User::all();
        return view('users', array('users' => $users));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit(Request $request, $id)
    {
        $user = User::find($id);

        if (request('name')) {


            $this->validate(request(), [
                'name' => 'required',
                'email' => 'required|email'
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

        return view('users_edit', array('id' => $user, 'user' => $user));

    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function block(Request $request, $id)
    {
        $user = User::find($id);
        $user->blocked = (int)!$user->blocked;
        $user->save();

        return redirect()->back();

    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request, $id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->back()->with('success', 'The user has deleted');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function add(Request $request)
    {
        $user = new User();
        if (request('name')) {
            $result = $this->validate(request(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
            ]);
            $user->email = request('email');
            $user->name = request('name');
            $user->role = request('role');
            $user->password = bcrypt(request('password'));


            if ($result) {
                $user->save();
            } else {
                return view('useradd', array('user' => $user))->withInput();
            }


            return redirect()->back()->with('success', 'The user has added');
        }
        return view('useradd');
    }
}
