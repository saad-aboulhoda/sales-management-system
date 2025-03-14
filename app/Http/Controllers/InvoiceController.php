<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['permission:invoice-list|invoice-create|invoice-show|invoice-cancel'], ['only' => ['index']]);
        $this->middleware(['permission:invoice-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:invoice-show'], ['only' => ['show']]);
        $this->middleware(['permission:invoice-cancel'], ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $invoices = Invoice::all();
        return view('invoice.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $customers = Customer::all();
        $products = Product::all();
        return View('invoice.create', compact('customers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([

            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id',
            'qty' => 'required',
            'qty.*' => 'required|numeric|min:1',
            'price' => 'required',
            'price.*' => 'required|numeric|min:0',
            'dis' => 'required',
            'dis.*' => 'required|numeric|min:0',
            'amount' => 'required',
            'amount.*' => 'required|numeric|min:0',
        ], [], [
            'customer_id' => 'الزبون',
            'product_id' => 'المنتج',
            'qty' => 'عدد العلب',
            'qty.*' => 'عدد العلب',
            'price' => 'ثمن العلبة',
            'price.*' => 'ثمن العلبة',
            'dis' => 'نسبة التخفيض',
            'dis.*' => 'نسبة التخفيض',
            'amount' => 'الملبغ',
            'amount.*' => 'الملبغ',
        ]);

        foreach ($request->product_id as $key => $product_id) {
            $product = Product::find($product_id);

            if ($product->box_qty < $request->qty[$key]) {
                return redirect()->back()->with('error', 'الكمية المتاحة للمنتج ' . $product->name . ' غير كافية!');
            }
        }

        $invoice = new Invoice();
        $invoice->customer_id = $request->customer_id;
        $invoice->total = array_sum($request->amount);
        $invoice->save();

        foreach ($request->product_id as $key => $product_id) {
            $sale = new Sale();
            $sale->qty = $request->qty[$key];
            $sale->price = $request->price[$key];
            $sale->dis = $request->dis[$key];
            $sale->amount = $request->amount[$key];
            $sale->product_id = $request->product_id[$key];
            $sale->invoice_id = $invoice->id;
            $sale->save();

            $product = Product::find($product_id);
            $product->box_qty -= $request->qty[$key];
            $product->save();
        }

        return redirect()->back()->with('message', 'تمت إضافة الفاتورة بنجاح!');
    }

    /**
     * Return a product price.
     */
    public function findPrice(Request $request): JsonResponse
    {
        $data = DB::table('products')->select('box_price')->where('id', $request->id)->first();
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice): View
    {
        $sales = Sale::where('invoice_id', $invoice->id)->get();
        return view('invoice.show', compact('invoice', 'sales'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice): void
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice): void
    {
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice): RedirectResponse
    {
        $invoice->status = false;
        $invoice->save();

        foreach ($invoice->sale as $sale) {
            $product = $sale->product;
            $product->box_qty += $sale->qty;
            $product->save();
        }

        return redirect()->back()->with('message', 'تم التراجع عن الفاتورة بنجاح!');
    }
}
