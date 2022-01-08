<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
{
    // public function index()
    // {
    //     $products = Product::with('category')->paginate(2);
    //     return view('wel', ['products' => $products]);
    // }

    public function create()
    {
        $categories = Category::all();
        return view('admin.add-product', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $product = new Product;

        $product->title = $request->input('title');
        $product->price = $request->input('price');
        $product->category_id = $request->input('category_id');
        if ($request->hasfile('image')) {
            $image = $request->file('image');
            $new_name = rand() . "_" . $image->getClientOriginalname();
            $image->move(public_path('uploads/images/'), $new_name);
            $product->image = $new_name;
        }

        $product->save();
        return redirect('/admin/dashboard');
    }

    public function edit($product)
    {
        $categories = Category::all();
        $product = Product::find($product);

        return view('admin.edit-product', ['product' => $product, 'categories' => $categories]);
    }

    public function update(Request $request, $product)
    {
        $product = Product::find($product);
        $product->title = $request->input('title');
        $product->price = $request->input('price');
        $product->category_id = $request->input('category_id');
        if ($request->hasfile('image')) {
            $destination = 'uploads/images/' . $product->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $image = $request->file('image');
            $new_name = rand() . "_" . $image->getClientOriginalname();
            $image->move(public_path('uploads/images/'), $new_name);
            $product->image = $new_name;
        }

        $product->update();
        return redirect('/admin/dashboard');
    }

    public function delete($product)
    {
        $product = Product::find($product);
        $destination = 'uploads/images/' . $product->image;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $product->delete();
        return redirect()->back();
    }

    public function search()
    {
        $search_text = $_GET['query'];

        $products = Product::where('title', 'LIKE', '%' . $search_text . '%')
            ->with('category')->paginate(3);

        return view('admin.search', ['products' => $products]);
    }



    public function getCategoryProduct($product)
    {
        $arr = Product::where('category_id', $product)->get();

        $product_ids = null;

        foreach ($arr as $pc)
            $product_ids[] = $pc->id;
        $products = Product::whereIn('id', $product_ids)->paginate(9);
        return view('home', ['products' => $products]);
    }
    
    
    public function getProductDetail($product)
    {
        $productDetail = Product::find($product);

        $related = Product::where('category_id', '=', $productDetail->category->id)
            ->where('id', '!=', $productDetail->id)
            ->get();

        return view('products.productdetail', ['productDetail' => $productDetail, 'related' => $related]);
    }
}

