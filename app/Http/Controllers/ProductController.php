<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','store']]);
        $this->middleware('permission:product-create', ['only' => ['create','store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(5);

        return view('products.index',compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'prijs' => 'required',
            'link'=>'required',
        ]);
        if (request()->hasFile('image')){
            request()->validate([
                'image' => 'file|image|max:5000',
            ]);
        }

        $product = Product::create($request->all());
        $this->storeImage($product);

        return redirect()->route('products.index')
            ->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
            'prijs' => 'required',
            'link'=>'required',
            'image'=> 'file'

        ]);
        if (request()->hasFile('image')){
            request()->validate([
                'image' => 'file|image|max:5000',
            ]);
        }

        $product->update($request->all());
        $this->storeImage($product);

        return redirect()->route('products.index')
            ->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success','Product deleted successfully');
    }

    public function storeImage($product){

        if (request()->has('image')){
            $product->update([
                'image' =>request()->image->store('uploads', 'public')
            ]);

        }
    }

//    private function validateRequest(){
//
//        $validatedData = request()->validate([
//            'name' => 'required',
//            'detail' => 'required',
//            'prijs' => 'required',
//            'link'=>'required',
//        ]);
//
//        if(request()->hasFile('image')){
//            request()->validate([
//               'image'=>'file|image|max:5000'
//            ]);
//        }
//
//        return $validatedData;
//    }


}
