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
}
