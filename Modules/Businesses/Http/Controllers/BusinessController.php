<?php 

namespace Modules\Businesses\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Businesses\Models\Business;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

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
        $defaultCover = 'default-covers/cover' . rand(1, 32) . '.jpg';
        $coverPath = 'covers/' . uniqid() . '.jpg';
        Storage::copy('public/' . $defaultCover, 'public/' . $coverPath);
        $business->cover_photo = $coverPath;

        $initial = strtoupper(substr($request->name, 0, 1));
        $filename = 'logos/' . uniqid() . '.png';
        
        $image = (new ImageManager())->canvas(128, 128, '#f2f2f2')
            ->text($initial, 64, 64, function ($font) {
                $font->file(public_path('fonts/Roboto-Bold.ttf'));
                $font->size(64);
                $font->color('#ffffff');
                $font->align('center');
                $font->valign('center');
            });
        
        Storage::put("public/{$filename}", (string) $image->encode());
        $business->logo = $filename;

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