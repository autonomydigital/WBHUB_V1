<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of all users.
     */
    public function index()
    {
        $users = User::all();
        return view('users', compact('users'));
    }

    public function show($id)
    {
        $user = User::with('socials')->findOrFail($id);
    
        // Calculate profile completion if needed
        $fields = [
            'first_name', 'last_name', 'email', 'phone', 'bio', 'avatar'
        ];
    
        $filled = 0;
        foreach ($fields as $field) {
            if (!empty($user->$field)) $filled++;
        }
        $completion = intval(($filled / count($fields)) * 100);
    
        return view('pages-profile', compact('user', 'completion'));
    }

    public function showProfile($id)
{
    $user = User::with('socials')->findOrFail($id);

    // Optional profile completion logic:
    $fields = ['first_name', 'last_name', 'email', 'phone', 'bio', 'avatar'];
    $filled = collect($fields)->filter(fn($field) => !empty($user->$field))->count();
    $completion = intval(($filled / count($fields)) * 100);

    return view('pages-profile', compact('user', 'completion'));
}
}