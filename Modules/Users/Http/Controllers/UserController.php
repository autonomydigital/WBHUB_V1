<?php

namespace Modules\Users\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $authUser = Auth::user();

        $users = User::query();

        // if (!$authUser->hasRole('superadmin')) {
        //     $users->where('role', 'customer'); // customize filtering as needed
        // }

        $users = $users->latest()->paginate(20);

        return view('users::index', compact('users', 'authUser'));
    }

    public function filter(Request $request)
{
    $query = User::query();

    if ($request->filled('query')) {
        $q = $request->input('query');
        $query->where(function ($sub) use ($q) {
            $sub->where('first_name', 'like', "%$q%")
                ->orWhere('last_name', 'like', "%$q%")
                ->orWhere('email', 'like', "%$q%")
                ->orWhere('suburb', 'like', "%$q%");
        });
    }

    if ($request->filled('role')) {
        $query->role($request->input('role'));
    }

    $perPage = $request->input('per_page');

    if ($perPage === 'all') {
        $perPage = 999999; // fallback large number
    }
    
    if (!is_numeric($perPage)) {
        $perPage = 20;
    }

    switch ($request->input('sort')) {
        case 'name_asc':
            $query->orderBy('first_name');
            break;
        case 'name_desc':
            $query->orderByDesc('first_name');
            break;
        case 'email_asc':
            $query->orderBy('email');
            break;
        case 'email_desc':
            $query->orderByDesc('email');
            break;
        case 'suburb_asc':
            $query->orderBy('suburb');
            break;
        case 'suburb_desc':
            $query->orderByDesc('suburb');
            break;
        default:
            $query->latest();
            break;
    }

    if ($request->filled('relation')) {
        if ($request->relation === 'following') {
            $query->whereIn('id', auth()->user()->following()->pluck('users.id'));
        }
    
        if ($request->relation === 'connected') {
            $query->whereIn('id', auth()->user()->connections()->pluck('users.id'));
        }
    }
    

    $users = $query->paginate((int) $perPage);

    // 🔥 Only return pagination if not lazy
    if ($request->query('pagination')) {
        return view('users::partials._pagination', compact('users'))->render();
    }
    
    return view('users::partials._user_cards', compact('users'))->render();
}
}
