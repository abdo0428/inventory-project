<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = [
            'app_name' => Setting::get('app_name', 'Inventory Mini'),
            'default_low_stock_threshold' => (int) Setting::get('default_low_stock_threshold', 5),
            'cache_reports' => (bool) Setting::get('cache_reports', true),
        ];

        return view('settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'app_name' => 'required|string|max:255',
            'default_low_stock_threshold' => 'required|integer|min:0',
            'cache_reports' => 'nullable|boolean',
        ]);

        Setting::set('app_name', $data['app_name']);
        Setting::set('default_low_stock_threshold', $data['default_low_stock_threshold']);
        Setting::set('cache_reports', $request->boolean('cache_reports'));

        return back()->with('success', __('ui.Settings saved successfully.'));
    }
}
