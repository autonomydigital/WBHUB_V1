<?php

namespace Modules\WebsiteContent\Http\Controllers;

use App\Models\Business;
use Modules\WebsiteContent\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PLPController extends Controller
{
    // Home page for PLP website
    public function home($business)
    {
        $business = Business::where('subdomain', $business)->firstOrFail();

        return view('websitecontent::websites.plp.pages.home', compact('business'));
    }

    // Property listings page with optional filter (e.g. sale, rent, sold)
    public function listings(Request $request, $business, $listingType = null)
    {
        $business = Business::where('subdomain', $business)->firstOrFail();

        $query = Property::where('business_id', $business->id);

        if ($listingType) {
            $query->where('listing_type', $listingType);
        }

        $properties = $query->latest()->paginate(8);

        if ($request->ajax()) {
            return view('websitecontent::websites.plp.partials.properties-loop', compact('properties', 'business', 'listingType'));
        }

        return view('websitecontent::websites.plp.pages.listings', [
            'business' => $business,
            'properties' => $properties,
            'listingType' => $listingType,
        ]);
    }

    // Single property page
    public function show($business, $slug)
    {
        $business = Business::where('subdomain', $business)->firstOrFail();

        $property = Property::where('business_id', $business->id)
            ->where('slug', $slug)
            ->firstOrFail();

        return view('websitecontent::websites.plp.pages.property', [
            'business' => $business,
            'property' => $property,
        ]);
    }
}