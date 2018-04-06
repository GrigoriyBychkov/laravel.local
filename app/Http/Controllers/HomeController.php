<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use App\News;
use App\Attachment;
use Redirect;
use Session;


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

    public function showGoods()
    {
        $products = Product::paginate(5);
        $categories = Category::all();
        return view('goods_show_customer', array('products'=>$products, 'categories'=>$categories));
    }

    public function showGoodsForCategory($category_id)
    {
        $products = Product::where('category_id','=',$category_id)->paginate(5);
        $categories = Category::all();
        return view('goods_show_customer', array('products'=>$products, 'categories'=>$categories));
    }


}
