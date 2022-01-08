<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(2);    
        return view('admin.category', ['categories' => $categories]);
    }

    public function create()
    {
        return view('admin.add-category');  
    }

    public function store(Request $request)
    {
        $input = $request->all();

        Category::create($input);
        return redirect('/admin/category');
    }

    public function edit($category)
    {
        $category = Category::find($category);
        return view('admin.edit-category', ['category' => $category]);
    }

    public function update(Request $request, $category)
    {
        $input = $request->all();

        $category = Category::find($category);
        $category->name = $input['name'];

        $category->save();

        return redirect('/admin/category');
    }

    public function delete($category)
    {
        Category::find($category)->delete();

        return redirect()->back();
    }

    public function search()
    {
        $search_text = $_GET['query'];

        $categories = Category::where('name', 'LIKE', '%' . $search_text . '%')
            ->with('category')->paginate(2);

        return view('admin.search-category', ['categories' => $categories]);
    }
}

