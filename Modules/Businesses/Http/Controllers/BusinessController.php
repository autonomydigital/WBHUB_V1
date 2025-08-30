<?php 

namespace Modules\Businesses\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Businesses\Models\Business;
use Illuminate\Support\Facades\Storage;
use Laravolt\Avatar\Avatar;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;


class BusinessController extends Controller
{
    public function index(Request $request)
    {
        $businesses = auth()->user()
            ->businesses()
            ->latest() // sorts by created_at desc
            ->paginate(20); // or use ->simplePaginate() if you prefer
    
        return view('businesses::index', compact('businesses'));
    }

    public function create()
    {
        return view('businesses::create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);

        $business = Business::create([
            'name' => $request->name,
            'description' => $request->description,
            'street' => $request->street,
            'suburb' => $request->suburb,
            'state' => $request->state,
            'postcode' => $request->postcode,
            'country' => $request->country ?? 'Australia',
            'created_by' => auth()->id(),
        ]);

        // Assign a random default cover
        $coverFile = public_path('default-covers/cover' . rand(1, 32) . '.jpg');
        $coverPath = 'covers/' . uniqid() . '.jpg';
        
        if (File::exists($coverFile)) {
            Storage::disk('public')->put($coverPath, File::get($coverFile));
            $business->cover_photo = $coverPath;
        }

        $initial = strtoupper(substr($request->name, 0, 1)); // 2 letters like "WB"

        // Clone the current config and override shape + size
        $bgColors = [
            '#fca5a5', // soft red
            '#fdba74', // light orange
            '#fcd34d', // soft gold
            '#86efac', // mint green
            '#6ee7b7', // teal
            '#93c5fd', // pastel blue
            '#a5b4fc', // lavender
            '#c084fc', // soft purple
            '#f9a8d4', // rose pink
            '#f472b6', // deeper pink
        ];
        
        $randomBg = $bgColors[array_rand($bgColors)];
        
        $customConfig = Config::get('avatar');
        $customConfig['width'] = 240;
        $customConfig['height'] = 100;
        $customConfig['shape'] = 'square';
        $customConfig['font_size'] = 48;
        $customConfig['backgrounds'] = [$randomBg];  // ← randomized here
        $customConfig['foregrounds'] = ['#ffffff'];
        
        // Inject config manually
        $avatar = new Avatar($customConfig);
        $avatarBase64 = $avatar->create($initial)->toBase64();
        
        $logoPath = 'logos/' . uniqid() . '.png';
        $avatarBinary = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $avatarBase64));
        Storage::disk('public')->put($logoPath, $avatarBinary);
        
        $business->logo = $logoPath;

        $business->save();

        $business->users()->attach(auth()->id(), ['role' => 'owner']);

        return redirect()->route('businesses.show', $business);
    }

    public function show(Business $business)
    {
        return view('businesses::show', compact('business'));
    }

    public function edit(Business $business)
    {
        if ($business->created_by !== auth()->id()) abort(403);
        return view('businesses::edit', compact('business'));
    }

    public function update(Request $request, Business $business)
    {
        if ($business->created_by !== auth()->id()) abort(403);

        $request->validate(['name' => 'required|string|max:255']);
        $business->update($request->only([
            'name', 'description', 'street', 'suburb', 'state', 'postcode', 'country'
        ]));

        return redirect()->route('businesses.show', $business);
    }
}