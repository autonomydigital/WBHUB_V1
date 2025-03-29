<?php

namespace Modules\UserProfiles\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\LoginHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class UserProfilesController extends Controller
{
    public function profile()
    {
        $user = auth()->user();
        return view('UserProfiles::profile', compact('user'));
        }

    public function profileSettings()
    {
        $user = auth()->user()->load('socials');
        $history = LoginHistory::where('user_id', $user->id)
            ->orderByDesc('logged_in_at')
            ->limit(10)
            ->get();

        return view('profile-settings', compact('user','history'));
    }

    public function updateProfile(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($request->hasFile('avatar')) {
            try {
                if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                    Storage::disk('public')->delete($user->avatar);
                }

                $avatarPath = $request->file('avatar')->store('avatars', 'public');
                $user->avatar = $avatarPath;
                $user->save();

                return response()->json([
                    'message' => 'Avatar updated successfully.',
                    'avatar_url' => asset('storage/' . $avatarPath)
                ]);
            } catch (\Exception $e) {
                Log::error('Avatar upload failed:', ['message' => $e->getMessage()]);
                return response()->json(['message' => 'Server error while uploading avatar.'], 500);
            }
        }

        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name'  => 'required|string|max:50',
            'email'      => 'required|email|unique:users,email,' . $id,
            'phone'      => 'nullable|string|max:20',
            'bio'        => 'nullable|string|max:1000',
            'suburb'     => 'nullable|string|max:100',
            'state'      => 'nullable|string|max:100',
            'postcode'   => 'nullable|string|max:10',
        ]);

        $user->update($request->only(['first_name', 'last_name', 'email', 'phone', 'bio', 'suburb', 'state', 'postcode']));

        return $request->ajax()
            ? response()->json(['message' => 'Profile updated successfully.'])
            : back()->with('message', 'Profile updated successfully!');
    }

    public function profileCompletion()
    {
        $user = auth()->user()->fresh();
        return response()->json(['percent' => $user->profileCompletionPercent()]);
    }

    public function updateSocials(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->socials()->delete();
        $unique = [];

        if ($request->has('socials')) {
            foreach ($request->input('socials') as $platform => $social) {
                $key = strtolower($social['platform'] ?? $platform);
                if (in_array($key, $unique)) continue;
                $unique[] = $key;

                if (!empty($social['handle'])) {
                    $user->socials()->create([
                        'platform' => $key,
                        'handle'   => $social['handle'],
                        'color'    => $social['color'] ?? 'bg-secondary',
                        'icon'     => $social['icon'] ?? 'ri-global-fill',
                    ]);
                }
            }
        }

        return $request->ajax()
            ? response()->json(['message' => 'Socials updated!'])
            : back()->with('message', 'Socials updated!');
    }

    public function deleteSocial($platform)
    {
        $user = auth()->user();
        $deleted = $user->socials()->where('platform', $platform)->delete();
        return response()->json(['deleted' => $deleted]);
    }

    public function updateCoverPhoto(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            if ($request->hasFile('cover_photo')) {
                if ($user->cover_photo && Storage::disk('public')->exists($user->cover_photo)) {
                    Storage::disk('public')->delete($user->cover_photo);
                }
                $coverPath = $request->file('cover_photo')->store('covers', 'public');
                $user->cover_photo = $coverPath;
                $user->save();
                return response()->json(['message' => 'Cover photo updated successfully!', 'cover_url' => asset('storage/' . $coverPath)]);
            }
            return response()->json(['message' => 'No file provided.'], 422);
        } catch (\Exception $e) {
            Log::error('Cover photo update failed', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Error updating cover photo.'], 500);
        }
    }

    public function listDefaultCovers()
    {
        try {
            $files = File::files(public_path('default-covers'));
            $covers = collect($files)->map(fn($file) => $file->getFilename())->filter()->values();
            Log::info('Default covers loaded:', $covers->toArray());
            return response()->json(['covers' => $covers]);
        } catch (\Exception $e) {
            Log::error('Error loading default covers:', ['error' => $e->getMessage()]);
            return response()->json(['covers' => []], 200);
        }
    }

    public function chooseDefaultCover(Request $request)
    {
        $request->validate(['filename' => 'required|string']);
        $filename = $request->input('filename');
        $fullPath = public_path('default-covers/' . $filename);

        if (!File::exists($fullPath)) {
            return response()->json(['message' => 'Cover not found.'], 404);
        }

        try {
            $user = auth()->user();
            if ($user->cover_photo && Storage::disk('public')->exists($user->cover_photo)) {
                Storage::disk('public')->delete($user->cover_photo);
            }
            $newPath = 'covers/' . uniqid() . '_' . $filename;
            Storage::disk('public')->put($newPath, file_get_contents($fullPath));
            $user->cover_photo = $newPath;
            $user->save();

            return response()->json(['message' => 'Cover updated.', 'cover_url' => asset('storage/' . $newPath)]);
        } catch (\Exception $e) {
            Log::error('Error saving cover: ' . $e->getMessage());
            return response()->json(['message' => 'Error saving cover.'], 500);
        }
    }

    public function updatePassword(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => ['required'],
            'new_password' => [
                'required', 'string', 'min:8',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'confirmed'
            ]
        ], [
            'new_password.regex' => 'New password must contain at least one uppercase letter and one number.',
            'new_password.confirmed' => 'New password and confirmation do not match.'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::findOrFail($id);

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['errors' => ['current_password' => ['Your current password is incorrect.']]], 422);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json(['message' => 'Password updated successfully!']);
    }

    public function validateCurrentPassword(Request $request)
    {
        $request->validate(['current_password' => 'required|string']);
        $isValid = Hash::check($request->current_password, auth()->user()->password);
        return response()->json(['valid' => $isValid]);
    }

    public function getLoginHistory()
    {
        $history = LoginHistory::where('user_id', auth()->id())
            ->latest('logged_in_at')
            ->take(10)
            ->get();

        return view('pages-profile-settings', compact('history'));
    }

    public function clearLoginHistory(Request $request)
    {
        LoginHistory::where('user_id', auth()->id())->delete();

        return $request->ajax()
            ? response()->json(['message' => 'Login history cleared.'])
            : back()->with('message', 'Login history cleared.');
    }

    public function updateSecuritySetting(Request $request)
    {
        $request->validate([
            'field' => 'required|in:two_factor_enabled,secondary_verification',
            'value' => 'required|boolean',
        ]);

        $user = auth()->user();
        $user->{$request->field} = $request->value;
        $user->save();

        return response()->json(['message' => 'Security setting updated.']);
    }
}
