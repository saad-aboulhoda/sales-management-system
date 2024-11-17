<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Supplier;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     */
    public function index(): View
    {
        $totalProducts = Product::count();
        $totalSales = Sale::count();
        $totalSuppliers = Supplier::count();
        $totalInvoices = Invoice::count();

        // Fetch monthly sales data from the sales table
        $monthlySales = Sale::selectRaw('SUM(qty) as total_amount, MONTH(created_at) as month')
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();

        $formattedMonthlySales = [];
        foreach ($monthlySales as $sale) {
            $formattedMonthlySales[] = [
                'month' => \DateTime::createFromFormat('!m', $sale->month)->format('F'), // Format month name
                'total_amount' => (int)$sale->total_amount // Ensure the amount is an integer
            ];
        }

        $topSales = Sale::select('product_id', DB::raw('SUM(qty) as total_sales'))
            ->groupBy('product_id')
            ->orderByDesc('total_sales')
            ->take(5)
            ->get();

        $formattedTopSales = [];
        foreach ($topSales as $sale) {
            $product = Product::find($sale->product_id);
            if ($product) {
                $formattedTopSales[] = [
                    'productName' => $product->name,
                    'totalSales' => $sale->total_sales,
                ];
            }
        }

        // Get today's date and yesterday's date
        $today = Carbon::today()->toDateString();
        $yesterday = Carbon::yesterday()->toDateString();

        // Query sales data for today and yesterday
        $todaySales = Sale::whereDate('created_at', $today)->sum('qty');
        $yesterdaySales = Sale::whereDate('created_at', $yesterday)->sum('qty');

        // Fetch this week's sales
        $thisWeekSales = Sale::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->sum('qty');

        // Fetch last week's sales
        $lastWeekSales = Sale::whereBetween('created_at', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()])
            ->sum('qty');

        return view('home', [
            'monthlySales' => $formattedMonthlySales,
            'formattedTopSales' => $formattedTopSales,
            'totalProducts' => $totalProducts,
            'totalSales' => $totalSales,
            'totalSuppliers' => $totalSuppliers,
            'totalInvoices' => $totalInvoices,
            'todaySales' => $todaySales,
            'yesterdaySales' => $yesterdaySales,
            'thisWeekSales' => $thisWeekSales,
            'lastWeekSales' => $lastWeekSales,
        ]);
    }

    /**
     * Show the form for editing the user profile.
     * @return View
     */
    public function edit_profile(): View
    {
        return view('profile.edit_profile');
    }

    /**
     * Update the user profile.
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function update_profile(Request $request, $id): RedirectResponse
    {
        $user = User::find($id);
        $user->f_name = $request->f_name;
        $user->l_name = $request->l_name;
        $user->email = $request->email;

        if ($request->hasFile('image')) {
            $image_path = "images/user/" . $user->image;
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            $imageName = request()->image->getClientOriginalName();
            request()->image->move(public_path('images/user/'), $imageName);
            $user->image = $imageName;
        }

        if ($request->filled(['current_password', 'new_password', 'confirm_password'])) {
            // Validate password change fields
            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:8|different:current_password',
                'confirm_password' => 'required|same:new_password',
            ]);

            // Verify if the entered current password matches the actual password
            if (Hash::check($request->current_password, $user->password)) {
                // Check if the new and confirm passwords match
                if ($request->new_password !== $request->confirm_password) {
                    return redirect()->back()->with('error', 'كلمة المرور الجديدة وتأكيد كلمة المرور غير متطابقين');
                }

                // Hash and update the new password
                $user->password = Hash::make($request->new_password);
            } else {
                return redirect()->back()->with('error', 'كلمة المرور الحالية غير صحيحة');
            }
        }


        $user->save();

        return redirect()->back()->with('success', 'تم تحديث الملف الشخصي بنجاح');
    }
}
