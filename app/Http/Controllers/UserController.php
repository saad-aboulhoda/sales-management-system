<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller
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
        $users = User::all();
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'f_name' => 'required|min:3',
            'l_name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|numeric|unique:users,mobile',
            'password' => 'required|min:8|confirmed',
            'roles' => 'required',
            'image' => 'mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ], [], [
            'f_name' => 'الاسم',
            'l_name' => 'النسب',
            'email' => 'البريد الإلكتروني',
            'mobile' => 'رقم الهاتف',
            'password' => 'كلمة المرور',
            'roles' => 'الوظائف',
            'image' => 'الصورة الشخصية'
        ]);

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/user/'), $imageName);
            $input['image'] = $imageName;
        } else {
            $input['image'] = null;
        }

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->back()->with('message', 'تمت إضافة المستخدم بنجاح!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): void
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): RedirectResponse|View
    {
        if ($id == Auth::user()->id) {
            return redirect()->route('edit_profile');
        }
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        return view('user.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'f_name' => 'required|min:3',
            'l_name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . $id,
            'mobile' => 'required|numeric|unique:users,mobile,' . $id,
            'password' => 'nullable|min:8|confirmed',
            'roles' => 'required',
            'image' => 'mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ], [], [
            'f_name' => 'الاسم',
            'l_name' => 'النسب',
            'email' => 'البريد الإلكتروني',
            'mobile' => 'رقم الهاتف',
            'password' => 'كلمة المرور',
            'roles' => 'الوظائف',
            'image' => 'الصورة الشخصية'
        ]);

        $input = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/user/'), $imageName);
            $input['image'] = $imageName;
        }

        if (!empty($input['password'])) {
            $input['password'] = bcrypt($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($request->input('roles'));

        return redirect()->back()->with('message', 'تم تحديث بيانات المستخدم بنجاح!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('message', 'تم حذف المستخدم بنجاح!');
    }
}
