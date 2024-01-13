<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;

class CategoryController extends Controller
{
    public function createCategory(Request $request){
        $newCategory = new Categories();

        $newCategory->id = $request->id;
        $newCategory->cat_code = $request->cat_code;
        $newCategory->categoryName = $request->categoryName;
        //$newCategory->productCount = $request->productCount;

        $res = $newCategory->save();

        return $res;
    }

    public function getCategory(){
        return Categories::all();
    }
}
