<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display the general setting index page.
     */
    public function index()
    {
        return view('backend.settings.generalSettings');
    }

    /**
     * Create or update general setting content.
     */
    public function store(Request $request)
    {
        try {
            // save if there is an header logo
            if ($request->hasFile('header_logo')) {
                try {
                    $request->validate([
                        'header_logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                    ]);

                    if (settings('header_logo')) {
                        Storage::delete('public/' . settings('header_logo'));
                    }

                    $filePath = $request->file('header_logo')->storeAs('backend/settings', Str::uuid() . '.' .  $request->file('header_logo')->getClientOriginalName(), 'public');
                    Setting::updateOrCreate(['name' => 'header_logo'], ['value' => $filePath]);
                } catch (\Exception $e) {
                    Session::flash('error', 'Header logo update failed: ' . $e->getMessage());
                    return back();
                }
            }

            // save if there is an footer logo
            if ($request->hasFile('footer_logo')) {
                try {
                    $request->validate([
                        'footer_logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                    ]);

                    if (settings('footer_logo')) {
                        Storage::delete('public/' . settings('footer_logo'));
                    }

                    $filePath = $request->file('footer_logo')->storeAs('backend/settings', Str::uuid() . '.' .  $request->file('footer_logo')->getClientOriginalName(), 'public');
                    Setting::updateOrCreate(['name' => 'footer_logo'], ['value' => $filePath]);
                } catch (\Exception $e) {
                    Session::flash('error', 'Footer logo update failed: ' . $e->getMessage());
                    return back();
                }
            }


            // save if there is an favicon
            if ($request->hasFile('favicon')) {
                try {
                    $request->validate([
                        'favicon' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                    ]);

                    if (settings('favicon')) {
                        Storage::delete('public/' . settings('favicon'));
                    }

                    $filePath = $request->file('favicon')->storeAs('backend/settings', Str::uuid() . '.' .  $request->file('favicon')->getClientOriginalName(), 'public');
                    Setting::updateOrCreate(['name' => 'favicon'], ['value' => $filePath]);
                } catch (\Exception $e) {
                    Session::flash('error', 'Favicon update failed: ' . $e->getMessage());
                    return back();
                }
            }

            Setting::updateOrCreate(['name' => 'application_name'], ['value' => $request->application_name]);
            Setting::updateOrCreate(['name' => 'application_email'], ['value' => $request->application_email]);
            Setting::updateOrCreate(['name' => 'application_phone'], ['value' => $request->application_phone]);

            Setting::updateOrCreate(['name' => 'instagram'], ['value' => $request->instagram]);
            Setting::updateOrCreate(['name' => 'linkedin'], ['value' => $request->linkedin]);
            Setting::updateOrCreate(['name' => 'facebook'], ['value' => $request->facebook]);
            Setting::updateOrCreate(['name' => 'twitter'], ['value' => $request->twitter]);
        } catch (\Exception $e) {
            Session::flash('error', 'Something went wrong');
            return back();
        }
        Session::flash('success', 'Successfully updated');
        return back();
    }
}
