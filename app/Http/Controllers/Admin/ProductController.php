<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductAddTransaction;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $supplier = Supplier::all();
        $color = Color::all();
        $brand = Brand::all();
        $category = Category::all();
        return view('admin.product.create', compact('supplier', 'color', 'brand', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //image upload
        $file = $request->file('image');
        $file_name = uniqid() . $file->getClientOriginalName();
        $file->move(public_path('/images'), $file_name);
        //product store
        $product =   Product::create([
            'supplier_id' => $request->supplier_id,
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'slug' => uniqid() . Str::slug($request->name),
            'name' => $request->name,
            'image' => $file_name,
            'description' => $request->description,
            'total_quantity' => $request->total_quantity,
            'sale_price' => $request->sale_price,
            'buy_price' => $request->buy_price,
        ]);

        // add to product add transaction
        ProductAddTransaction::create([
            'product_id' => $product->id,
            'supplier_id' => $request->supplier_id,
            'buy_price' => $request->buy_price,
            'buy_date' => date('Y-m-d'),
            'total_quantity' => $request->total_quantity,
            'description' => $request->tran_description,
        ]);
        // store to pivot
        $product = Product::find($product->id);
        $product->color()->sync($request->color_id);
        return redirect()->back()->with('success', 'Product Created Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::where('id', $id)->with('supplier', 'color', 'brand', 'category')->first();
        if (!$product) {
            return redirect()->back()->with('error', 'Product Not found!');
        }

        $supplier = Supplier::all();
        $color = Color::all();
        $brand = Brand::all();
        $category = Category::all();

        return view('admin.product.edit', compact('supplier', 'color', 'brand', 'category', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::where('id', $id);
        if (!$product->first()) {
            return redirect()->back()->with('error', 'Product Not found!');
        }

        $product_id = $product->first()->id;

        //image
        if ($file = $request->file('image')) {
            $file_name = uniqid() . $file->getClientOriginalName();
            $file->move(public_path('/images'), $file_name);
            File::delete(public_path('/images/' . $product->first()->image));
        } else {
            $file_name = $product->first()->image;
        }

        //product upadte
        $product->update([
            'supplier_id' => $request->supplier_id,
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'slug' => uniqid() . Str::slug($request->name),
            'name' => $request->name,
            'image' => $file_name,
            'description' => $request->description,
            'sale_price' => $request->sale_price,
        ]);

        // color sync
        $product = Product::find($product_id);
        $product->color()->sync($request->color_id);

        return redirect()->back()->with('success', 'Product Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $find_product = Product::where('id', $id);
        //file del
        File::delete(public_path('/images/' . $find_product->first()->image));
        //remove product
        $find_product->delete();
        return redirect()->back()->with('success', 'Product Deleted');
    }

    public function showProductAdd($id)
    {
        $product = Product::find($id);
        $supplier = Supplier::all();
        return view('admin.product.create-add', compact('product', 'supplier'));
    }

    public function storeProductAdd($id)
    {
        //trans
        ProductAddTransaction::create([
            'product_id' => $id,
            'supplier_id' => request()->supplier_id,
            'buy_price' => request()->buy_price,
            'total_quantity' => request()->total_quantity,
            'buy_date' => date('Y-m-d'),
            'description' => request()->description,

        ]);

        Product::where('id', $id)->update([
            'total_quantity' => DB::raw('total_quantity+' . request()->total_quantity),
        ]);
        return redirect()->back()->with('success', request()->total_quantity . ' Added.');
    }

    public function showProductAddTran()
    {
        $transactions =  ProductAddTransaction::latest()
            ->with('product', 'supplier')
            ->paginate(10);
        return $transactions;
        return view('admin.product.product-add-tran', compact('transactions'));
    }
}
