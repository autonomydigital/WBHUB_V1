<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Notifications\EmailVerificationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravolt\Avatar\Facade as Avatar;
use Illuminate\Support\Facades\File;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required','string','max:50'],
            'last_name'  => ['required','string','max:50'],
            'email'      => ['required','string','email','max:255','unique:users'],
            'password'   => ['required','string','min:8','regex:/^(?=.*[A-Z])(?=.*\d).+$/','confirmed'],
            // 'avatar'  => removed from validation
        ]);
    }

    protected function create(array $data)
{
    // Pick a random cover image
    $defaultCovers = File::files(public_path('default-covers'));
    $randomCover = null;

    if (count($defaultCovers)) {
        $randomFile = $defaultCovers[array_rand($defaultCovers)];
        $filename = $randomFile->getFilename();

        $path = 'covers/' . uniqid() . '_' . $filename;
        Storage::disk('public')->put($path, file_get_contents($randomFile->getPathname()));
        $randomCover = $path;
    }

    // Generate initials for avatar
    $initials = strtoupper(substr($data['first_name'], 0, 1) . substr($data['last_name'], 0, 1));

    // Generate avatar using Laravolt
    $avatarBase64 = Avatar::create($initials)->toBase64();

    // Convert to file and save
    $avatarPath = 'avatars/' . uniqid() . '.png';
    $avatarBinary = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $avatarBase64));
    Storage::disk('public')->put($avatarPath, $avatarBinary);

    // Create user
    $user = User::create([
        'first_name'   => $data['first_name'],
        'last_name'    => $data['last_name'],
        'email'        => $data['email'],
        'password'     => Hash::make($data['password']),
        'avatar'       => $avatarPath,
        'cover_photo'  => $randomCover,
    ]);

    $user->assignRole('user');
    $user->notify(new \App\Notifications\EmailVerificationCode());

    return $user;
}

    protected function registered(Request $request, $user)
    {
        return redirect()->route('verification.notice');
    }
}
