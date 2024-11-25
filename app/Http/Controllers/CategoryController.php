<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['permission:category-list|category-create|category-edit|category-delete'], ['only' => ['index']]);
        $this->middleware(['permission:category-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:category-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:category-delete'], ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $categories = Category::all();
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|min:3|unique:categories',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ], [], [
            'image' => 'صورة التصنيف'
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->status = 1;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/category/'), $imageName);
            $category->image = $imageName;
        }
        $category->save();

        return redirect()->back()->with('message', 'تمت إضافة التصنيف الجديدة بنجاح!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): void
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category): View
    {
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category): RedirectResponse
    {
        $request->validate([
            'name' => 'required|min:3|unique:categories',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ], [], [
            'image' => 'صورة التصنيف'
        ]);

        $category->name = $request->name;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/category/'), $imageName);
            $category->image = $imageName;
        }
        $category->save();

        return redirect()->back()->with('message', 'تم تحديث التصنيف بنجاح!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();
        return redirect()->back()->with('message', 'تم حذف التصنيف بنجاح!');
    }
}
