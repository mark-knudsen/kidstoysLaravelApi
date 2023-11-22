<?php

namespace App\Http\Controllers;

use App\Models\categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
      // get all categories
      public function index()
      {
          $categories = categories::all();
          return response()->json([
              "categories" => $categories
          ], 200);
      }
      // post category
      public function store(Request $request)
      {
          $category = categories::create(
              $request->toArray()
          );
          if(!is_null($category)) {
              $msg = 'category is created';
          }else {
              $msg = 'could not create category';
          }
          return response()->json(
          [
          "msg" => $msg,
          "category" => $category
          ], 200);
      }
  
      // update category
      public function complete(Request $request)
      {
          $category = categories::whereId($request->id)->first();
          if(!is_null($category)){
              $category->completed = !$category->completed;
              $category->save();
          }
          $category_changed = categories::whereId($request->id)->first();
          return response()->json(
              $category_changed, 200
          );
      }
      
    // update product
    public function update(Request $request)
    {
        $category = categories::find($request->id);

        if (is_null($category)) {
            return response(
                "Category with id {$request->id} not found",
                Response::HTTP_NOT_FOUND
            );
        }

        if ($category->update($request->all()) === false) {
            return response(
                "Couldn't update the category with id {$request->id}",
                Response::HTTP_BAD_REQUEST
            );
        }

        return response()->json(
            $category, 200
        );
    }

    // delete category
    public function delete(int $id)
    {
        $message = 'category not found';
        $category = categories::whereId($id)->first();
        if(!is_null($category)){
            $category->delete();
            $message = 'category deleted successfully';
        }
        return response()->json(
            $message, 200
        );
    }
}
