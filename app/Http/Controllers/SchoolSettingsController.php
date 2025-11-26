<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolSettings;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class SchoolSettingsController extends Controller
{
    /**
     * Show the form for editing school settings
     */
    public function edit()
    {
        $settings = SchoolSettings::getSettings();
        return view('admin.school-settings.edit', compact('settings'));
    }

    /**
     * Update school settings
     */
    public function update(Request $request)
    {
        $request->validate([
            'vision' => 'required|string|max:2000',
            'mission' => 'required|string|max:2000',
            'school_name' => 'required|string|max:255',
            'school_address' => 'required|string|max:500',
            'school_phone' => 'required|string|max:30',
            'school_email' => 'required|email|max:255',
            'home_description' => 'required|string|max:1000',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $settings = SchoolSettings::getSettings();

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = 'logo.' . $logo->getClientOriginalExtension();
            
            // Delete old logo if exists
            if ($settings->logo_path && $settings->logo_path !== 'logo.png') {
                $oldLogoPath = public_path($settings->logo_path);
                if (File::exists($oldLogoPath)) {
                    File::delete($oldLogoPath);
                }
            }
            
            // Save new logo to public directory
            $logo->move(public_path(), $logoName);
            $settings->logo_path = $logoName;
        }

        // Update vision, mission, and school info
        $settings->vision = $request->vision;
        $settings->mission = $request->mission;
        $settings->school_name = $request->school_name;
        $settings->school_address = $request->school_address;
        $settings->school_phone = $request->school_phone;
        $settings->school_email = $request->school_email;
        $settings->home_description = $request->home_description;
        $settings->save();

        return redirect()->route('admin.school-settings.edit')
            ->with('success', 'Pengaturan sekolah berhasil diperbarui!');
    }
}
