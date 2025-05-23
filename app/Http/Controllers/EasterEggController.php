<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserEasterEgg;

class EasterEggController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Ensure only logged-in users access this
    }

    /**
     * Store a newly discovered Easter Egg for the user.
     */
    public function store(Request $request)
    {

        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated',
            ], 401);
        }
        
        $request->validate([
            'egg_key' => 'required|string|max:255'
        ]);

        $userId = Auth::id();
        $eggKey = $request->input('egg_key');

        // Prevent duplicate egg records
        $existing = UserEasterEgg::where('user_id', $userId)
            ->where('egg_key', $eggKey)
            ->first();

        if ($existing) {
            return response()->json([
                'success' => false,
                'message' => 'Egg already found.'
            ], 200);
        }

        UserEasterEgg::create([
            'user_id' => $userId,
            'egg_key' => $eggKey,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Easter egg recorded!',
        ]);
    }

    /**
     * Return a list/count of Easter Eggs the user has found.
     */
    public function index()
    {
        $eggs = UserEasterEgg::where('user_id', Auth::id())->pluck('egg_key');

        return response()->json([
            'count' => $eggs->count(),
            'eggs' => $eggs,
        ]);
    }
}