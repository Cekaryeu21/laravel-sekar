<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
{
    //this method will show product page
    public function index() {
        $products = Product::orderBy('created_at','DESC')->get();

        return view('products.list',[
        'products' => $products
        ]);
    }

    

    //this method will show create product page
    public function create() {
        return view('products.create');
    }

    //this method will store a product in db
    public function store(Request $request) {
        $rules = [
            'nama_product' => 'required|min:5',
            'kategori' => 'required|min:3',
            'harga' => 'required|numeric',
            
        ];

        if($request->image != "") {
            $rules['image'] = 'image';
        }

    $validator = Validator::make($request->all(),$rules);

    if ($validator->fails()){
        return redirect()-> route('products.create')->withInput()->withErrors($validator);
    }

    //insert product in db
    $product = new Product();
    $product->nama_product = $request->nama_product;
    $product->kategori = $request->kategori;
    $product->harga = $request->harga;
    $product->save();

    if($request->image != "") {

    //code for store image
    $image = $request->image;
    $ext = $image->getClientOriginalExtension();
    $imageName = time().'.'.$ext; //unique image name

    //menyimpan foto di direktori product
    $image->move(public_path('uploads/products'),$imageName);

    //menyimpan nama foto di database
    $product->image = $imageName;
    $product->save();

    }
    
    return redirect()->route('products.index')->with('success','Product added successfully.');
}

    //this method will show edit product page
    public function edit($id) {
        $product = Product::findOrFail($id);
        return view('products.edit',[
            'product'=> $product
        ]);

    }

    //this method will update a product 
    public function update($id, Request $request) {

        $product = Product::findOrFail($id);

        $rules = [
            'nama_product' => 'required|min:100',
            'kategori' => 'required|min:25',
            'harga' => 'required|numeric',
            
        ];

        if($request->image != "") {
            $rules['image'] = 'image';
        }

    $validator = Validator::make($request->all(),$rules);

    if ($validator->fails()){
        return redirect()-> route('products.edit', $product->id)->withInput()->withErrors($validator);
    }

    //update product in db
    $product->nama_product = $request->nama_product;
    $product->kategori = $request->kategori;
    $product->harga = $request->harga;
    $product->save();

    if($request->image != "") {
    //delete old image
    File::delete(public_path('uploads/products/'.$product->image));

    //code for store image
    $image = $request->image;
    $ext = $image->getClientOriginalExtension();
    $imageName = time().'.'.$ext; //unique image name

    //menyimpan foto di direktori product
    $image->move(public_path('uploads/products'),$imageName);

    //menyimpan nama foto di database
    $product->image = $imageName;
    $product->save();

    }
    
    return redirect()->route('products.index')->with('success','Product updated successfully.');

    }
    
    //this method will delete a product 
     public function destroy($id) {
        $product = Product::findOrFail($id);

        //delete image
        File::delete(public_path('uploads/products/'.$product->image));

        //delete product dari database
        $product->delete();

        return redirect()->route('products.index')->with('success','Product deleted successfully.');

     }
}
