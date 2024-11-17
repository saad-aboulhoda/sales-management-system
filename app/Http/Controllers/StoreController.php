<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StoreController extends Controller
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
        $stores = Store::all();
        return view('store.index', compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('store.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|min:3',
            'adresse' => 'required|min:3',
            'notes' => 'nullable|min:3'
        ], [], [
            'name' => 'الاسم',
            'adresse' => 'العنوان',
            'notes' => 'ملاحظات'
        ]);

        $store = new Store();
        $store->name = $request->name;
        $store->adresse = $request->adresse;
        $store->notes = $request->notes;
        $store->status = 1;
        $store->save();

        return redirect()->back()->with('message', 'تمت إضافة المخزن بنجاح!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Store $store): void
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Store $store): View
    {
        return view('store.edit', compact('store'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Store $store): RedirectResponse
    {
        $request->validate([
            'name' => 'required|min:3',
            'adresse' => 'required|min:3',
            'notes' => 'nullable|min:3'
        ], [], [
            'name' => 'الاسم',
            'adresse' => 'العنوان',
            'notes' => 'ملاحظات'
        ]);

        $store->name = $request->name;
        $store->adresse = $request->adresse;
        $store->notes = $request->notes;
        $store->status = 1;
        $store->save();

        return redirect()->back()->with('message', 'تم تعديل المخزن بنجاح!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Store $store): RedirectResponse
    {
        $store->delete();
        return redirect()->back()->with('message', 'تم حذف المخزن بنجاح!');
    }
}
