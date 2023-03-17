<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\StorecategoryRequest;
use App\Http\Requests\UpdatecategoryRequest;



class CategoryController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function index()
    {
        $category = Category::all();
        return response()->json(['response'=>'success','categories'=>$category]);
    }

    public function store(Request $request)
    {
        $category = Category::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "category Created successfully!",
            'livre' => $category
        ], 201);
    }

   
    public function show(Category $category)
    {
        $category->find($category->id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        return response()->json($category, 200);
    }

   
  
   
    public function update(UpdatecategoryRequest $request, $id)
    {
        $category_update = Category::find($id);
        $category_update->update($request->all());
        return $category_update;
    }

    
    public function destroy(Category $category)
    {
        
        $category->delete();

        if (!$category) {
            return response()->json([
                'message' => 'category not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'category deleted successfully'
        ], 200);
}
}