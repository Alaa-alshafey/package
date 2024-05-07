<?php

namespace App\Http\Controllers\Admin;

use App\Http\Traits\SettingOperation;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    use SettingOperation;
    public function index($slug)
    {
        $settings = Setting::where('slug',$slug)->get();
        if (!$settings)
            return back();
        $settings_page = $settings->pluck('page')->first();
        return view('admin.setting')
            ->with('settings_page', $settings_page)
            ->with('settings', $settings);
    }
    public function StoreSetting(Request $request)
    {
        $this->RegisterSetting($request);
            return redirect()->back()->with('success', 'تم حفظ الاعدادت بنجاح' ); 
    }
}
