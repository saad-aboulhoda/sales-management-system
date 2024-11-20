<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['permission:customer-list|customer-create|customer-edit|customer-delete'], ['only' => ['index']]);
        $this->middleware(['permission:customer-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:customer-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:customer-delete'], ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $customers = Customer::all();
        return view('customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|min:3',
            'address' => 'nullable|min:3',
            'mobile' => 'nullable|digits:10',
            'notes' => 'nullable|min:3|',
        ], [], [
            'name' => 'الاسم',
            'address' => 'العنوان',
            'mobile' => 'رقم الهاتف',
            'notes' => 'ملاحظات',
        ]);

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->mobile = $request->mobile;
        $customer->email = $request->email;
        $customer->notes = $request->notes;
        $customer->save();

        return redirect()->back()->with('message', 'تمت إضافة الزبون بنجاح!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer): void
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer): View
    {
        return view('customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer): RedirectResponse
    {
        $request->validate([
            'name' => 'required|min:3',
            'address' => 'nullable|min:3',
            'mobile' => 'nullable|min:3|digits:10',
            'notes' => 'nullable|min:3|',
        ], [], [
            'name' => 'الاسم',
            'address' => 'العنوان',
            'mobile' => 'رقم الهاتف',
            'notes' => 'ملاحظات',
        ]);

        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->mobile = $request->mobile;
        $customer->notes = $request->notes;
        $customer->save();

        return redirect()->back()->with('message', 'تم تحديث بيانات الزبون بنجاح!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer): RedirectResponse
    {
        $customer->delete();
        return redirect()->back()->with('message', 'تم إزالة الزبون بنجاح!');
    }
}
