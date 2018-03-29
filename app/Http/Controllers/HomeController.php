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
        $news =  News::all();

        foreach ($news as $record){
            $record->views = $record->views+1;
            $record->save();
            $attachments = Attachments::where('news_id', '=', $record->id)->get();
            $record->attachments =$attachments;
        }
        return view('home', array('news' => $news));
    }


}
