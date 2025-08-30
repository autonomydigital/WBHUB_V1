<?php

namespace Modules\WebsiteContent\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Modules\WebsiteContent\Models\WebsitePage;
use App\Models\Business;

class WebsiteContentController extends Controller
{
    public function index()
    {
        return view('websitecontent::index'); // CMS dashboard (optional)
    }

    public function edit($businessId, $slug)
    {
        $content = WebsitePage::with(['sections', 'images'])
            ->where('business_id', $businessId)
            ->where('page_slug', $slug)
            ->first();

        if (!$content) {
            $content = new WebsitePage([
                'business_id' => $businessId,
                'page_slug' => $slug,
                'status' => 'Draft',
                'visibility' => 'Public',
                'publish_at' => now(),
            ]);
            $content->setRelation('sections', collect());
            $content->setRelation('images', collect());
        } else {
            $content->setRelation('sections', $content->sections()->orderBy('order')->get());
            $content->setRelation('images', $content->images()->orderBy('order')->get());
        }

        return view('websitecontent::edit', [
            'businessId' => $businessId,
            'slug' => $slug,
            'content' => $content,
        ]);
    }

    public function update(Request $request, $businessId, $slug)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:Draft,Published',
            'visibility' => 'required|in:Public,Hidden',
            'publish_at' => 'nullable|date_format:d.m.Y H:i',
            'sections' => 'array',
            'sections.*.content' => 'nullable|string',
            'images' => 'array',
            'images.*.url' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        DB::beginTransaction();

        try {
            $page = WebsitePage::firstOrCreate(
                ['business_id' => $businessId, 'page_slug' => $slug],
                ['status' => 'Draft', 'visibility' => 'Public']
            );

            $page->update([
                'status' => $request->status,
                'visibility' => $request->visibility,
                'publish_at' => $request->filled('publish_at')
                    ? Carbon::createFromFormat('d.m.Y H:i', $request->publish_at)
                    : now(),
            ]);

            $page->sections()->delete();
            foreach ($request->sections ?? [] as $i => $section) {
                $page->sections()->create([
                    'title' => 'Section ' . ($i + 1),
                    'content' => $section['content'] ?? '',
                    'order' => $i,
                ]);
            }

            $page->images()->delete();
            foreach ($request->images ?? [] as $i => $image) {
                $page->images()->create([
                    'title' => 'Image ' . ($i + 1),
                    'url' => $image['url'] ?? '',
                    'order' => $i,
                ]);
            }

            DB::commit();
            return response()->json(['message' => 'Page updated successfully']);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}