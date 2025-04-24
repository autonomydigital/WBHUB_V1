<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Create roles if not already existing
        foreach (['superadmin', 'admin', 'client', 'user'] as $role) {
            Role::findOrCreate($role);
        }

        $avatarFiles = File::files(public_path('storage/avatars'));
        $avatarFilenames = collect($avatarFiles)
        ->filter(fn($f) => $f->isFile())
        ->map(fn($f) => $f->getFilename())
        ->values()
        ->toArray();
        
        $defaultCovers = File::files(public_path('default-covers'));
        $defaultCoverFilenames = collect($defaultCovers)
        ->filter(fn($f) => $f->isFile())
        ->map(fn($f) => $f->getFilename())
        ->values()
        ->toArray();
        $usedAvatars = [];

        for ($i = 1; $i <= 100; $i++) {
            // 🧠 Fake name + email
            $firstName = fake()->firstName;
            $lastName = fake()->lastName;
            $email = Str::slug($firstName . '.' . $lastName . $i) . '@example.com';

            // 📞 Address
            $suburb = fake()->randomElement([
                'Bowen', 'Proserpine', 'Cannonvale', 'Airlie Beach', 'Mount Marlow',
                'Woodwark', 'Jubilee Pocket', 'Shute Harbour', 'Hamilton Island', 'Collinsville'
            ]);
            $state = 'QLD';
            $postcode = fake()->postcode;

            // 🎨 Random cover
            $coverFile = fake()->randomElement($defaultCoverFilenames);
            $coverPath = 'covers/' . uniqid() . '_' . $coverFile;

            File::copy(public_path("default-covers/{$coverFile}"), public_path("storage/{$coverPath}"));

            // 🖼️ Avatar: use renamed real avatars first, then initials fallback
            if ($i <= count($avatarFilenames)) {
                $avatarSource = $avatarFilenames[$i - 1];
                $avatarPath = 'avatars/' . $avatarSource;
                $usedAvatars[] = $avatarSource;
            } else {
                // initials-based avatar
                $initials = strtoupper(substr($firstName, 0, 1) . substr($lastName, 0, 1));
                $avatarPath = "avatars/" . Str::random(16) . "_{$initials}.png";
                // Generate image (optional if you already have them)
                $this->generateInitialAvatar($initials, public_path("storage/{$avatarPath}"));
            }

            // 🧠 Create user
            $user = User::create([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $email,
                'phone' => fake()->phoneNumber,
                'bio' => fake()->sentence,
                'suburb' => $suburb,
                'state' => $state,
                'postcode' => $postcode,
                'cover_photo' => $coverPath,
                'avatar' => $avatarPath,
                'password' => Hash::make('password'),
            ]);

            // 🎭 Assign random role
            $role = fake()->randomElement(['superadmin', 'admin', 'client', 'user']);
            $user->assignRole($role);
        }
    }

    // Optional initials image generator
    private function generateInitialAvatar($initials, $savePath)
    {
        $img = imagecreate(128, 128);
        $bg = imagecolorallocate($img, rand(150, 255), rand(150, 255), rand(150, 255));
        $textColor = imagecolorallocate($img, 255, 255, 255);

        $fontPath = public_path('fonts/arial.ttf'); // ensure you have a font
        if (!file_exists($fontPath)) return;

        imagettftext($img, 40, 0, 28, 78, $textColor, $fontPath, $initials);
        imagepng($img, $savePath);
        imagedestroy($img);
    }
}