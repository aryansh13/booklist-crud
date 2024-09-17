<?php

namespace App\Http\Controllers;

use App\Models\BookCategory;
use Illuminate\Http\Request;

class BookCategoryController extends Controller
{
    public function index() {
        $category = BookCategory::all();
        return view('categories.index', compact('category'));
    }

    public function store(Request $request) {
        $request->validate([     
            'name' => 'required',
        ]);

        $category = new BookCategory();
        $category->name = $request->name;
        $category->save();
        return redirect()->route('categories.index')->with('success', 'Category created successfully');
    }

    public function edit($id) {
        $category = BookCategory::findOrFail($id);
        return response()->json($category);
    }

    public function update(Request $request, $id) {
        $category = BookCategory::findOrFail($id);
        $category->update($request->all());
        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }

    public function destroy($id) {
        $category = BookCategory::findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
    }
}
