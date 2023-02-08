<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin')->except('show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest();

        if (request('search')) {
            $searchResult = request('search');
            $products = $products->where('name', 'like', "%$searchResult%");
        }

        return view('product.product', [
            "products" => $products->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('product.product_create', [
            "categories" => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $validatedData = $request->validate([
            "name" => 'required|max:255|unique:products,name',
            "category_id" => 'required',
            "description" => 'required',
            "price" => 'required|integer',
            "imagePath" => 'required|image|file|mimes:png,jpg,jpeg'
        ]);

        $validatedData['slug'] = Str::slug($validatedData['name']);

        if ($request->file('imagePath')) {
            $validatedData['imagePath'] = $request->file('imagePath')->store('product-images');
        }

        Product::create($validatedData);

        return redirect('/products')->with('created', 'Product has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('product.product_detail', [
            "product" => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('product.product_edit', [
            "categories" => $categories,
            "product" => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        // dd($request->file('photo'));
        $rules = [
            "name" => 'required|max:255',
            "category_id" => 'required',
            "description" => 'required',
            "price" => 'required|integer',
            "imagePath" => 'image|file|mimes:png,jpg,jpeg'
        ];

        $validatedData = $request->validate($rules);

        if ($request->file('imagePath')) {
            if ($request->oldPhoto && !str_contains($product['imagePath'], 'dummy')) {
                Storage::delete($request->oldPhoto);
            }
            $validatedData['imagePath'] = $request->file('imagePath')->store('product-images');
        }

        Product::where('id', $product['id'])->update($validatedData);

        return redirect('/products')->with('updated', 'Product has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if ($product->imagePath) {
            Storage::delete($product->imagePath);
        }

        $product->delete();

        return redirect('/products')->with('deleted', 'Product has been deleted!');
    }
}
