<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::query();

        if($request->search){
            $query->where('name','like','%'.$request->search.'%');
        }

        $categories = $query->latest()->paginate(10);

        return response()->json(['status'=>true,'data'=>$categories]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:255',
            'description'=>'nullable|string'
        ]);

        $category = Category::create($request->only('name','description'));

        return response()->json(['status'=>true,'message'=>'Category created','data'=>$category],201);
    }

    public function show($id)
    {
        $category = Category::find($id);
        if(!$category) return response()->json(['status'=>false,'message'=>'Not found'],404);

        return response()->json(['status'=>true,'data'=>$category]);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if(!$category) return response()->json(['status'=>false,'message'=>'Not found'],404);

        $request->validate([
            'name'=>'required|string|max:255',
            'description'=>'nullable|string'
        ]);

        $category->update($request->only('name','description'));

        return response()->json(['status'=>true,'message'=>'Category updated','data'=>$category]);
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if(!$category) return response()->json(['status'=>false,'message'=>'Not found'],404);

        $category->delete();
        return response()->json(['status'=>true,'message'=>'Category deleted']);
    }
}
