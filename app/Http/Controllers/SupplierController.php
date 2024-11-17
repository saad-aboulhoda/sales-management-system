<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SupplierController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $suppliers = Supplier::all();
        return view('supplier.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('supplier.create');
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
            'notes' => 'nullable|min:3',
        ], [], [
            'name' => 'الاسم',
            'address' => 'العنوان',
            'mobile' => 'رقم الهاتف',
            'notes' => 'ملاحظات',
        ]);

        $supplier = new Supplier();
        $supplier->name = $request->name;
        $supplier->address = $request->address;
        $supplier->mobile = $request->mobile;
        $supplier->notes = $request->notes;
        $supplier->save();

        return redirect()->back()->with('message', 'تمت إضافة المورد بنجاح!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier): void
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier): View
    {
        return view('supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier): RedirectResponse
    {
        $request->validate([
            'name' => 'required|min:3',
            'address' => 'nullable|min:3',
            'mobile' => 'nullable|digits:10',
            'notes' => 'nullable|min:3',
        ], [], [
            'name' => 'الاسم',
            'address' => 'العنوان',
            'mobile' => 'رقم الهاتف',
            'notes' => 'ملاحظات',
        ]);

        $supplier->name = $request->name;
        $supplier->address = $request->address;
        $supplier->mobile = $request->mobile;
        $supplier->notes = $request->notes;
        $supplier->save();

        return redirect()->back()->with('message', 'تم تعديل بيانات المورد بنجاح!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier): RedirectResponse
    {
        $supplier->delete();
        return redirect()->back()->with('message', 'تم حذف المورد بنجاح!');
    }
}
