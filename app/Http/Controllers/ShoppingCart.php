<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Session;


class ShoppingCart extends Controller
{
    public function productShow($id)
    {
        dump(Session::all());

        $product = Product::find($id);
        return view('product', array('product' => $product));
    }

    public function productOrder($id)
    {
        Session::push('order', ['id' => $id, 'quantity' => request('quantity')]);

        return redirect()->back()->with('success', 'product added to cart');
    }

    public function basket()
    {
        $orders = Session::get('order');
        $ids = [];
        dump($orders);

        foreach ($orders as $order) {
            $ids[] = $order['id'];

        }
        $productsMap = [];
        $products = Product::whereIn('id', $ids)->get();
        foreach ($products as $product) {
            $productsMap[$product->id] = $product;
        }

        $cartProducts = [];
        $total = 0;
        foreach ($orders as $order) {
            $order['product'] = $productsMap[$order['id']];
            $order['price'] = $order['product']->price * $order['quantity'];
            $cartProducts[] = $order;
            $total += $order['price'];
        }

        return view('basket', array('cartProducts' => $cartProducts, 'total' => $total));
    }

    public function orderDelete($id)
    {
        $orders = Session::get('order');
        $newOrders = [];

        foreach ($orders as $order) {
            if ($order['id'] != $id) {
                $newOrders[] = $order;
            }
        }

        Session::put('order', $newOrders);
        return redirect()->back();
    }

    public function acceptOrder()
    {

    }
}
