<?php

namespace App\Http\Controllers;

use App\Models\products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    // get all products
    public function index()
    {
        $products = products::all();
        return response()->json([
            "products" => $products
        ], 200);
    }
    // get  product by id
    public function getById(int $id)
    {
        $product = products::whereId($id)->first();
        if(!is_null($product)) {
            return response()->json([
                "product" => $product
            ], 200);
        }      
    }
    // post product
    public function store(Request $request)
    {
        $product = products::create(
            $request->toArray()
        );
        if(!is_null($product)) {
            $msg = 'product is created';
        }else {
            $msg = 'could not create product';
        }
        return response()->json(
        [
        "msg" => $msg,
        "product" => $product
        ], 200);
    }

    // update product - does not work!
    public function complete(Request $request)
    {
        $product = products::whereId($request->id)->first();
        if(!is_null($product)){
            $product->completed = !$product->completed;
            $product->save();
        }
        $product_changed = products::whereId($request->id)->first();
        return response()->json(
            $product_changed, 200
        );
    }
    // update product
    public function update(Request $request)
    {
        $product = products::find($request->id);

        if (is_null($product)) {
            return response(
                "Product with id {$request->id} not found",
                Response::HTTP_NOT_FOUND
            );
        }

        if ($product->update($request->all()) === false) {
            return response(
                "Couldn't update the product with id {$request->id}",
                Response::HTTP_BAD_REQUEST
            );
        }

        return response()->json(
            $product, 200
        );
    }
    // delete product
    public function delete(int $id)
    {
        $message = 'product not found';
        $product = products::whereId($id)->first();
        if(!is_null($product)){
            $product->delete();
            $message = 'product deleted successfully';
        }
        return response()->json(
            $message, 200
        );
    }
    
}
