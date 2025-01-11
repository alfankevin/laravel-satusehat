<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppInfo;

class AppInfoController extends Controller
{
    public function index()
    {
        $appInfo = AppInfo::first();
        return view('settings.app_info', compact('appInfo'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kode' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'telepon' => 'nullable|string|max:20',
            'provinsi' => 'nullable|string|max:100',
            'logo' => 'nullable|image|max:2048', // Validasi file
        ]);

        $appInfo = AppInfo::first();

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('logos', 'public');
            if ($appInfo && $appInfo->logo) {
                \Storage::disk('public')->delete($appInfo->logo);
            }
        }

        if ($appInfo) {
            $appInfo->update($validated);
        } else {
            AppInfo::create($validated);
        }

        // After updating AppInfo
        cache()->forget('app_info');
        cache()->rememberForever('app_info', function () {
            return AppInfo::first();
        });

        return redirect()->route('modul.index')->with('success', 'Informasi aplikasi berhasil disimpan.');
    }
}
