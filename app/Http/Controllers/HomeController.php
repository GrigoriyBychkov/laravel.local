<?php

namespace App\Http\Controllers;

use App\Category;
use App\Order;
use App\Product;
use Illuminate\Http\Request;
use App\News;
use App\Attachment;
use Redirect;
use Session;
use Illuminate\Support\Facades\Facade;


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

    public function showGoods($category_id = null)
    {
        $categories = Category::all();

        if ($category_id != null) {
            $products = Product::where('category_id', '=', $category_id)->paginate(5);

        } else {
            $products = Product::paginate(5);
        }
        return \View::make('goods_show_customer')->with(['products' => $products, 'categories' => $categories]);
    }

    public function myOrders(Request $request)
    {
        $orders = Order::where('user_id', '=', $request->user()->id)->get();

        return view('my_orders', array('orders' => $orders));
    }

    public function adminPageOrders()
    {
        $orders = Order::all();
        return view('admin_orders_page', array('orders' => $orders));
    }

}
