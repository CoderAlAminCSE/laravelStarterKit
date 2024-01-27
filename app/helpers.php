<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Auth;


//logged in user data
function loggedInUser()
{
  return Auth::user();
}

// get value from "settings" table
function settings($name)
{
  $setting = Setting::where('name', $name)->first();
  return $setting ? $setting->value : '';
}

//update env variable data
function overWriteEnvFile($type, $val)
{
  $path = base_path('.env');
  if (file_exists($path)) {
    $val = '"' . trim($val) . '"';
    if (is_numeric(strpos(file_get_contents($path), $type)) && strpos(file_get_contents($path), $type) >= 0) {
      file_put_contents($path, str_replace($type . '="' . env($type) . '"', $type . '=' . $val, file_get_contents($path)));
    } else {
      file_put_contents($path, file_get_contents($path) . "\r\n" . $type . '=' . $val);
    }
  }
}