<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderItem;
use Illuminate\Http\Request;
use App\Product;
use Session;


class ShoppingCart extends Controller
{
    public function productShow($id)
    {
        $product = Product::find($id);
        return view('product', array('product' => $product));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     *
     */
    public function productOrder(Request $request, $id)
    {
        $orders = Session::get('order');

        if ($orders == null) {
            $orders = [];
        }
        $quantity = request('quantity');
        $orders[$id] = $quantity;


        Session::put('order', $orders);

        return redirect()->back()->with('success', 'product added to cart');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function basket()
    {
        $orders = Session::get('order');
        $products = Product::whereIn('id', array_keys($orders))->get()->keyBy('id');

        $cartProducts = [];
        $total = 0;

        foreach ($orders as $product_id => $quantity) {
            $cartProducts [] = [
                'price' => $products[$product_id]->price,
                'quantity' => $quantity,
                'product' => $products[$product_id],
            ];
            $total += $products[$product_id]->price * $quantity;
        }

        return view('basket', array('cartProducts' => $cartProducts, 'total' => $total));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function orderDelete($id)
    {
        $orders = Session::get('order');
        unset($orders[$id]);
        Session::put('order', $orders);

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function acceptOrder(Request $request)
    {
        $order = New Order();
        $order->user_id = $request->user()->id;
        $order->save();
        $sessionItems = Session::get('order');
        foreach ($sessionItems as $product_id => $quantity) {
            $item = New OrderItem();
            $item->order_id = $order->id;
            $item->product_id = $product_id;
            $item->quantity = $quantity;
            $item->save();
        }
        Session::put('order', []);
        return redirect()->route('home');

    }
}
