<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\Attachments;
use Redirect;


class HomeController extends Controller
{
//    use Hash;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::paginate(5);

        return view('home', array('news' => $news));
    }

    public function show($id)
    {
        $news = News::find($id);
        $news->views++;
        $news->save();
        return view('news_show_customer', array('news' => $news));
    }


}
