<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 22.03.2018
 * Time: 11:31
 */

namespace App\Http\Controllers;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin');
    }
}