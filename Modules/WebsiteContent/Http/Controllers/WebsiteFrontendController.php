<?php

namespace Modules\WebsiteContent\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Modules\WebsiteContent\Models\WebsitePage;
use App\Models\Business;
use Illuminate\Http\Request;
use Modules\WebsiteContent\Models\NewsPost;
use App\Models\Property;

class WebsiteFrontendController extends Controller
{
    protected function getBusiness($subdomain = null)
    {
        return app()->bound('currentBusiness')
            ? app('currentBusiness')
            : Business::where('subdomain', $subdomain)->firstOrFail();
    }

    protected function resolveHomeRouteName(): string
    {
        return Route::currentRouteNamed('website.*.custom') ? 'website.home.custom' : 'website.home';
    }

    protected function resolveProfileRouteName(): string
    {
        return Route::currentRouteNamed('website.*.custom') ? 'website.profile.custom' : 'website.profile';
    }

    public function home()
    {
        $businessModel = $this->getBusiness(); // ← don't use $business param
    
        Log::info('🏠 Home fired', ['subdomain' => $businessModel->subdomain]);
    
        if (!$businessModel->has_website) {
            return $this->publicProfile($businessModel->subdomain);
        }
    
        return view("websitecontent::websites.{$businessModel->website_layout}.pages.home", [
            'business' => $businessModel,
            'properties' => [],
            'suburbs' => [],
        ]);
    }

    public function page($business = null, $slug = null)
    {

        Log::info('🏠 page controller hit!', ['business' => $business]);

        $businessModel = $this->getBusiness($business);

        if (!$businessModel->has_website) {
            return redirect()->route($this->resolveProfileRouteName(), ['business' => $businessModel->subdomain]);
        }

        if ($slug === 'home') {
            return redirect()->route($this->resolveHomeRouteName(), ['business' => $businessModel->subdomain]);
        }

        // Try to load a Blade view first
        $customView = "websitecontent::websites.{$businessModel->website_layout}.pages.{$slug}";
        if (view()->exists($customView)) {
            return view($customView, ['business' => $businessModel]);
        }

        // Fallback to CMS
        $content = WebsitePage::with(['sections', 'images'])
            ->where('business_id', $businessModel->id)
            ->where('page_slug', $slug)
            ->firstOrFail();

        return view('websitecontent::frontend.page', [
            'business' => $businessModel,
            'content' => $content,
        ]);
    }

    public function publicProfile($business = null)
    {
        $businessModel = $this->getBusiness($business);
        Log::info("🔍 Public profile hit for: {$businessModel->name}");

        return view('websitecontent::frontend.profile', [
            'business' => $businessModel,
        ]);
    }

    public function news($business = null)
    {
        $businessModel = $this->getBusiness($business);
    
        $newsPosts = NewsPost::where('business_id', $businessModel->id)
            ->where('published', true)
            ->orderByDesc('published_at')
            ->paginate(6); // or use ->get() if you don't want pagination
    
        return view("websitecontent::websites.{$businessModel->website_layout}.pages.news", [
            'business' => $businessModel,
            'newsPosts' => $newsPosts,
        ]);
    }

    public function submitContactForm(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);
    
        Log::info('📬 New contact form submitted', $data);
    
        // Optionally send an email or save to DB here
    
        return back()->with('success', 'Thanks for getting in touch! We’ll get back to you soon.');
    }
}