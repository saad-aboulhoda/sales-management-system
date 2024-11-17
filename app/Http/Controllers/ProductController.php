<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['permission:product-list|product-create|product-edit|product-delete'], ['only' => ['index']]);
        $this->middleware(['permission:product-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:product-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:product-delete'], ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = Category::all();
        $stores = Store::all();
        return view('product.create', compact('categories', 'stores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|min:3|unique:products',
            'model' => 'required|min:3',
            'category_id' => 'required',
            'store_id' => 'required',
            'image' => 'file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'qty' => 'required|integer|min:0',
            'box_price' => 'required|min:0',
            'box_qty' => 'required|integer|min:0',

        ], [], [
            'model' => 'الموديل',
            'category_id' => 'تصنيف المنتج',
            'store_id' => 'المخزن',
            'image' => 'صورة المنتج',
            'qty' => 'عدد المنتجات في العلبة',
            'box_price' => 'ثمن العلبة',
            'box_qty' => 'عدد العلب',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->model = $request->model;
        $product->category_id = $request->category_id;
        $product->box_price = $request->box_price;
        $product->box_qty = $request->box_qty;
        $product->qty = $request->qty;
        $product->store_id = $request->store_id;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/product/'), $imageName);
            $product->image = $imageName;
        }

        $product->save();

        return redirect()->back()->with('message', 'تمت إضافة المنتج بنجاح!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): void
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): View
    {
        $categories = Category::all();
        $stores = Store::all();
        return view('product.edit', compact('product', 'categories', 'stores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $request->validate([
            'name' => 'required|min:3|unique:products,name,' . $product->id,
            'model' => 'required|min:3',
            'category_id' => 'required',
            'store_id' => 'required',
            'image' => 'file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'qty' => 'required|integer|min:0',
            'box_price' => 'required|min:0',
            'box_qty' => 'required|integer|min:0',
        ], [], [
            'model' => 'الموديل',
            'category_id' => 'تصنيف المنتج',
            'store_id' => 'المخزن',
            'image' => 'صورة المنتج',
            'qty' => 'عدد المنتجات في العلبة',
            'box_price' => 'ثمن العلبة',
            'box_qty' => 'عدد العلب',
        ]);

        $input = $request->all();
        // Remove _token and _method from the input array
        array_splice($input, 0, 2);

        if ($request->hasFile('image')) {
            $existingImagePath = public_path("images/product/{$product->image}");
            if (file_exists($existingImagePath) && is_file($existingImagePath)) {
                unlink($existingImagePath);
            }

            $imageName = time() . '_' . uniqid() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/product/'), $imageName);

            $input['image'] = $imageName;
        }

        $product->update($input);

        return redirect()->back()->with('message', 'تم تعديل المنتج بنجاح!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();
        return redirect()->back()->with('تم حذف المنتج بنجاح!');
    }
}
