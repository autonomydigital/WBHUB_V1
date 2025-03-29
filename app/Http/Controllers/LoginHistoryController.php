<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginHistoryController extends Controller
{
    public function clear()
{
    auth()->user()->loginHistories()->delete();

    return response()->json(['message' => 'Login history cleared.']);
}
}
