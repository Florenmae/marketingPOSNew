<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function createProduct(Request $request){
        $newProduct =  new Product();

        $newProduct->id = $request->id;
        $newProduct->name = $request->name;
        $newProduct->supplier = $request->supplier;
        $newProduct->product_code = $request->product_code;
        $newProduct->item_code = $request->item_code;
        $newProduct->price = $request->price;
        $newProduct->qty = $request-> qty;
        $newProduct->description = $request->description;

        $res = $newProduct->save();

        return $res;
    }

    public function getProducts(){
        return Product::all();
    }

    public function updateProduct(Request $request){
        $product = Product :: findOrFail($request->editingProductId);

        $product->name = $request->prodPayload["name"];
        $product->supplier = $request->prodPayload["supplier"];
        $product->product_code = $request->prodPayload["product_code"];
        $product->item_code = $request->prodPayload["item_code"];
        $product->price = $request->prodPayload["price"];
        $product->qty = $request->prodPayload["qty"];
        $product->description = $request->prodPayload["description"];

        $product->save();

        return $product;

    }

    public function deleteProduct(Request $request){
        // dd($request->id);
        $deleteProduct = Product::find($request->id);

        $res = $deleteProduct->delete();
        return $res;
    }
}
