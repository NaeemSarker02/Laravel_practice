<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function list() {
        return Category::all();
    }

    public function store(Request $request) {
        $request->validate([
            'name'=>'required',
            'description'=>'required',
        ]);

        return Category::create($request->only('name','description'));
    }

    public function edit($id) {
        return Category::findOrFail($id);
    }

    public function update(Request $request, $id) {
        $category = Category::findOrFail($id);

        $request->validate([
            'name'=>'required',
            'description'=>'required',
        ]);

        $category->update($request->only('name','description'));

        return $category;
    }

    public function delete($id) {
        Category::findOrFail($id)->delete();
        return ['message'=>'Category deleted successfully'];
    }
}
