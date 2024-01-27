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