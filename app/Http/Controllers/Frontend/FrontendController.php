<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {

        $sliders = Slider::where('status', '0')->get();
        $trendingProducts = Product::where('trending', '1')->latest()->take(10)->get();
        $newArrivalProducts = Product::latest()->take(9)->get();
        return view('frontend.index', compact('sliders', 'trendingProducts', 'newArrivalProducts'));
    }

    public function searchProduct(Request $request){
         
        if($request->search){
            
            $searchProduct = Product::where('name', 'LIKE', '%'.$request->search. '%')->latest()->paginate(5);

            return view('frontend.pages.search',compact('searchProduct'));

        }else{

            return redirect()->back()->with('message','Empty Search');
        }

    }
    
    public function newArrival()
    {
        $newArrivalProducts = Product::latest()->take(3)->get();
        return view('frontend.pages.new-arrival', compact( 'newArrivalProducts'));
    }
    public function categories()
    {

        $categories = Category::where('status', '0')->get();
        // dd($categories);
        return view('frontend.collections.category.index', compact('categories'));
    }

    public function products($category_slug)
    {

        $category = Category::where('slug', $category_slug)->first();

        if ($category) {

            $products = $category->products()->get();
            // dd($products);
            return view('frontend.collections.products.index', compact('products', 'category'));
        } else {
            return redirect()->back();
        }
    }

    public function productView(string $category_slug, string $product_slug)
    {

        $category = Category::where('slug', $category_slug)->where('status', '0')->first();
        if ($category) {

            $product = $category->products()->where('slug', $product_slug)->where('status', '0')->first();

            if ($product) {

                return view('frontend.collections.products.view', compact('product', 'category'));
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }

    public function thankYou(){

        return view('frontend.thankyou');
    }
}
