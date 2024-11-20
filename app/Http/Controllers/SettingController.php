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
        $input = $request->except('_token');
        foreach ($input as $name => $value) {
            $setting = Setting::where('option_name', $name)->first();
            if ($setting) {
                $setting->option_value = $value;
                $setting->save();
            }
        }

        return redirect()->route('setting.settings')->with('success', 'تم حفظ الإعدادات بنجاح');
    }
}
