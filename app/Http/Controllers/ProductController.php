<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function index(){
        try {
            $list = Product::get()->toArray();
        } catch (ModelNotFoundException $e) {
            return response(json_encode('Unable to retreive products', [JSON_THROW_ON_ERROR]), 400);
        }

        return response()->json($list);
    }

    public function productInfo($uuid){
        try {
            $product = Product::where('uuid', $uuid)->firstOrFail()->toArray();
        } catch (ModelNotFoundException $e) {
            return response(json_encode('Product not found'), 400);
        }

        return response()->json($product);
    }
}
