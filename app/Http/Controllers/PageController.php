<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\User;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home(Request $request)
    {
        $color = Color::all();
        $category = Category::all();
        $brand = Brand::all();
        $product = Product::latest()
            ->with('category');

        if ($request->category) {
            $find_category = Category::where('slug', $request->category)->first(); //{}
            if (!$find_category) {
                return redirect('/')->with('error', 'category not found');
            }
            $product->where('category_id', $find_category->id);
        }

        if ($request->brand) {
            $find_brand = Brand::where('slug', $request->brand)->first(); //{}
            if (!$find_brand) {
                return redirect('/')->with('error', 'brand not found');
            }
            $product->where('brand_id', $find_brand->id);
        }

        if ($request->color) {
            $find_color = Color::where('slug', $request->color)->first();
            if (!$find_color) {
                return redirect('/')->with('error', 'color not found');
            }
            $color_id = $find_color->id;
            $product->whereHas('color', function ($q) use ($color_id) {
                return $q->where('product_color.color_id', $color_id);
            });
        }

        if ($request->search) {
            $search = $request->search;
            $product->where('name', 'like', "%$search%");
        }

        $product = $product->paginate(12);

        return view(
            'home',
            compact('color', 'category', 'brand', 'product')
        );
    }



    public function productDetail($slug)
    {
        $product = Product::where('slug', $slug)
            ->with('color', 'brand', 'category', 'review.user')
            ->first();

        if (!$product) {
            return redirect('/')->with('error', 'product not found');
        }
        return view('product-detail', compact('product'));
    }

    public function makeReview()
    {
        ProductReview::create([
            'user_id' => auth()->id(),
            'product_id' => request()->product_id,
            'review' => request()->review,
        ]);

        $user_name = auth()->user()->name;
        $review = request()->review;
        return '
        <div class="crad border p-3">
        <small class="text-muted">' . $user_name . '</small>
        <br>
        <p class="p-3">
           ' . $review . '
        </p>
    </div>
        ';
    }

    public function editProfile()
    {
        return view('user-profile');
    }
}
