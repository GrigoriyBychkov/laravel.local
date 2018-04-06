<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('products', array('products' => $products));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('products_create', array('categories' => $categories));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = New Product();

        $product->name = request('name');
        $product->description = request('description');
        $product->category_id = request('category_id');
        $image = $request->file('input_img');
        if ($image) {
            $product->img = self::handleProductImage($image);
        }
        $product->price = request('price');

        $product->save();

        return redirect()->route('product.index')->with('success', 'The News has added');
    }

    private function handleProductImage($image)
    {

        $name = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/productImages');
        $image->move($destinationPath, $name);
        return $name;
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $product = Product::find($id);

        return view('products_edit', array('categories' => $categories, 'product' => $product));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->name = request('name');
        $product->description = request('description');
        $product->category_id = request('category_id');
        $product->price = request('price');

        $product->save();

        return redirect()->back()->with('success', 'Product was updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->route('product.index');
    }
}
