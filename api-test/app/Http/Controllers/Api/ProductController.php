<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        if($request->search){
            $query->where('name','like','%'.$request->search.'%');
        }

        $products = $query->latest()->paginate(10);

        return response()->json(['status'=>true,'data'=>$products]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:255',
            'quantity'=>'required|integer',
            'price'=>'required|numeric',
            'category_id'=>'required|exists:categories,id'
        ]);

        $product = Product::create($request->all());

        return response()->json(['status'=>true,'message'=>'Product created','data'=>$product],201);
    }

    public function show($id)
    {
        $product = Product::with('category')->find($id);
        if(!$product) return response()->json(['status'=>false,'message'=>'Not found'],404);

        return response()->json(['status'=>true,'data'=>$product]);
    }

    public function update(Request $request,$id)
    {
        $product = Product::find($id);
        if(!$product) return response()->json(['status'=>false,'message'=>'Not found'],404);

        $request->validate([
            'name'=>'required|string|max:255',
            'quantity'=>'required|integer',
            'price'=>'required|numeric',
            'category_id'=>'required|exists:categories,id'
        ]);

        $product->update($request->all());
        return response()->json(['status'=>true,'message'=>'Product updated','data'=>$product]);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if(!$product) return response()->json(['status'=>false,'message'=>'Not found'],404);

        $product->delete();
        return response()->json(['status'=>true,'message'=>'Product deleted']);
    }
}
