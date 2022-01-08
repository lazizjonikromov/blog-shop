<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at', 'DESC')->paginate(9);
        return view('home', ['products' => $products]);
    }

    public function search()
    {
        $search_text = $_GET['query'];

        $products = Product::where('title', 'LIKE', '%' . $search_text . '%')
            ->with('category')->paginate(9);

        return view('search', ['products' => $products]);
    }

    function getAdminDashboard(){
        $usertype = Auth::user()->usertype;

        if($usertype == '1'){
            $products = Product::with('category')->paginate(3);
            return view('admin.dashboard', ['products' => $products]);
        }else{
            return view('user.dashboard');
        }
    }

    function getUserDashboard(){
        $usertype = Auth::user()->usertype;

        if($usertype == '0'){
            return view('user.dashboard');
        }else{
            $products = Product::with('category')->paginate(3);
            return view('admin.dashboard',['products'=>$products]);        
        }
    }


    // public function redirect(){
    //     $usertype = Auth::user()->usertype;

    //     if($usertype == '1'){
    //         return view('admin.home');
    //     }else{
    //         return view('dashboard');
    //     }
    // }
}

