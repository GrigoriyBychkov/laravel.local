<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(){
        $news = News::where('active',1)->orderBy('created_at','desc')->paginate(5);
        $title = 'Last news';
        return view('home')->withNews($news)->withTitle($title);
    }

    public function create(Request $request){
        return view('news_create');
    }

    public function addNews(Request $request){
        return view('news_add');
    }
}
