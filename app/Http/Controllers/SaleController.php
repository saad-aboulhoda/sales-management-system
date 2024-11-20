<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SaleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['permission:sales-list'], ['only' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $sales = Sale::all();
        return view('sale.index', compact('sales'));
    }
}
