<?php

use Illuminate\Support\Facades\Auth;


//logged in user data
function loggedInUser()
{
  return Auth::user();
}