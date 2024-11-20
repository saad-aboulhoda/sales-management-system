<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['permission:settings'], ['only' => ['settings', 'save']]);
    }
    /**
     * Display the specified resource.
     */
    public function settings(): View
    {
        $settings = Setting::all();
        return view('setting.settings', compact('settings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function save(Request $request): RedirectResponse
    {
        $request->validate([
            'option_name.*' => 'required|unique:settings,option_name',
            'option_value.*' => 'required|min:3',
        ], [], [
            'option_value' => 'القيمة',
        ]);

        foreach ($request->option_name as $key => $name) {
            $setting = Setting::where('option_name', $name)->first();
            $setting->value = $request->option_value[$key];
            $setting->save();
        }

        return redirect()->route('setting.show')->with('success', 'تم حفظ الإعدادات بنجاح');
    }
}
