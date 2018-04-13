<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
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
    public function store(ProductRequest $request)
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
    public function update(ProductRequest $request, $id)
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

    public function uploadForm()
    {
        $categories = Category::all();

        return view('upload_product_file', ['categories' => $categories]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uploadFormConfirm(Request $request)
    {
        $file = $request->file('file');
        $ext = $file->getClientOriginalExtension();
        $category = request('category_id');
        if ($ext == "xml") {
            self::addProductsFromXml($file, $category);
        } elseif ($ext == "csv") {
            self::addProductsFromCsv($file, $category);
        }

        return redirect()->back()->with('success', 'Products Were Uploaded');
    }

    public function addProductsFromXml($file, $category)
    {
        $xml = simplexml_load_file($file);

        foreach ($xml->product as $key => $value) {
            $product = New Product();
            $product->category_id = $category;
            $product->name = $value->name;
            $product->description = $value->description;
            $product->price = $value->price;
            $product->save();
        }
    }

    public function addProductsFromCsv($file, $category)
    {
        $csv = array_map('str_getcsv', file($file));

        foreach ($csv as $key => $value) {
            $product = New Product();
            $product->category_id = $category;
            $product->name = $value[0];
            $product->description = $value[1];
            $product->price = $value[2];
            $product->save();
        }
    }

}
