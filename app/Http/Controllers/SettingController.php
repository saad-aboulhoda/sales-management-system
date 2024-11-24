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

        $logo = '';
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/category/'), $imageName);
            $logo = $imageName;
        }

        $input = $request->except('_token');
        foreach ($input as $name => $value) {
            $setting = Setting::where('option_name', $name)->first();
            if ($setting) {
                if ($name == 'logo') {
                    if (!empty($logo)) {
                        $setting->option_value = $logo;
                    }
                } else {
                    $setting->option_value = $value;
                }
                $setting->save();
            }
        }

        return redirect()->route('setting.settings')->with('success', 'تم حفظ الإعدادات بنجاح');
    }
}
