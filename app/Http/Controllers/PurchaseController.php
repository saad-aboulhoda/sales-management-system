<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PurchaseController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['permission:purchase-list|purchase-create|purchase-show|purchase-cancel'], ['only' => ['index']]);
        $this->middleware(['permission:purchase-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:purchase-show'], ['only' => ['show']]);
        $this->middleware(['permission:purchase-cancel'], ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $purchases = Purchase::all();
        return view('purchase.index', compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $suppliers = Supplier::all();
        $products = Product::all();
        return view('purchase.create', compact('suppliers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'date' => 'required|date',
            'price' => 'required|numeric:min:0',
            'product_id.*' => 'required|exists:products,id',
            'box_qty.*' => 'required|numeric|min:1',
            'box_price.*' => 'required|numeric|min:0',
            'total_price.*' => 'required|numeric|min:0',
        ], [], [
            'supplier_id' => 'المورد',
            'date' => 'تاريخ الشراء',
            'price' => 'الثمن الكلي',
            'product_id.*' => 'المنتج',
            'box_qty.*' => 'عدد العلب',
            'box_price.*' => 'ثمن العلبة',
            'total_price.*' => 'المجموع',
        ]);

        $purchase = new Purchase();
        $purchase->supplier_id = $request->supplier_id;
        $purchase->purchase_date = $request->date;
        $purchase->total_price = $request->price;
        $purchase->status = true;

        $purchase->save();

        foreach ($request->product_id as $key => $productId) {
            $purchase->products()->create([
                'product_id' => $productId,
                'box_price' => $request->box_price[$key],
                'box_qty' => $request->box_qty[$key],
                'total_price' => $request->total_price[$key],
            ]);

            $product = Product::find($productId);
            $product->box_qty += $request->box_qty[$key];
            $product->save();
        }

        return redirect()->back()->with('message', 'تمت عملية الشراء بنجاح!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase): View
    {
        return view('purchase.show', compact('purchase'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase): void
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Purchase $purchase): void
    {
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase): RedirectResponse
    {
        $purchase->status = false;
        $purchase->save();

        foreach ($purchase->products as $product) {
            $theProduct = Product::find($product->id);
            $theProduct->box_qty -= $product->box_qty;
            $theProduct->save();
        }

        return redirect()->back()->with('message', 'تم التراجع عن عملية الشراء بنجاح!');
    }
}
