@extends('layouts.master')

@section('title') Edit Website Page @endsection

@section('css')
<link href="{{ URL::asset('build/libs/dropzone/dropzone.css') }}" rel="stylesheet">
@endsection

@section('content')
@component('components.breadcrumb')
    @slot('li_1') Website @endslot
    @slot('title') Edit Page @endslot
@endcomponent

<form id="editpage-form"
      method="POST"
      action="{{ route('websitecontent.update', ['business' => $businessId, 'slug' => $slug]) }}"
      enctype="multipart/form-data"
      class="needs-validation"
      novalidate>
    @csrf
    <div class="row">
        <div class="col-lg-8">

            {{-- Main Editor --}}
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label" for="page-title-input">Page Title</label>
                        <input type="text" class="form-control" id="page-title-input" value="{{ ucfirst($slug) }}" readonly>
                    </div>

                    @foreach ($content->sections as $index => $section)
                        <div class="mb-4">
                            <label class="form-label">{{ $section->title ?? 'Section ' . ($index + 1) }}</label>
                            <div id="ckeditor-classic-{{ $index }}" class="ckeditor-classic"></div>
                            <input type="hidden" name="sections[{{ $index }}][content]" id="section-{{ $index }}-input">
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Images --}}
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Images</h5>
                </div>
                <div class="card-body">
                    @foreach ($content->images as $index => $image)
                        <div class="mb-4">
                            <h5 class="fs-14 mb-1">{{ $image->title ?? 'Image ' . ($index + 1) }}</h5>
                            <p class="text-muted">Upload an image.</p>

                            <div class="text-center">
                                <div class="position-relative d-inline-block">
                                    <div class="avatar-lg">
                                        <div class="avatar-title bg-light rounded">
                                            <img src="{{ $image->url ?? '' }}" id="image-preview-{{ $index }}" class="avatar-md h-auto" />
                                        </div>
                                    </div>
                                    <div class="position-absolute top-100 start-100 translate-middle">
                                        <label for="image-input-{{ $index }}" class="mb-0" title="Select Image">
                                            <div class="avatar-xs">
                                                <div class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                                                    <i class="ri-image-fill"></i>
                                                </div>
                                            </div>
                                        </label>
                                        <input class="form-control d-none image-input"
                                               id="image-input-{{ $index }}"
                                               name="images[{{ $index }}][file]"
                                               type="file"
                                               accept="image/*">
                                    </div>
                                </div>
                            </div>

                            <input type="hidden"
                                   name="images[{{ $index }}][url]"
                                   id="image-url-{{ $index }}"
                                   value="{{ $image->url ?? '' }}">
                        </div>
                    @endforeach

                    {{-- Gallery --}}
                    <div>
                        <h5 class="fs-14 mb-1">Gallery</h5>
                        <p class="text-muted">Upload additional images.</p>
                        <div class="dropzone">
                            <div class="fallback">
                                <input name="gallery[]" type="file" multiple="multiple">
                            </div>
                            <div class="dz-message needsclick">
                                <div class="mb-3">
                                    <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
                                </div>
                                <h5>Drop files here or click to upload.</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Submit --}}
            {{-- <div class="text-end mb-3">
                <button type="submit" id="savePageBtn" class="btn btn-success w-sm">Save Page</button>
            </div> --}}
        </div>

       <!-- Right Column (Sidebar) -->
        <div class="col-lg-4">
            <div class="position-sticky" style="top: 80px; z-index: 100;">
                <!-- Save Button Block -->
                <div class="card mb-3 bg-light-subtle border-0 shadow-sm">
                    <div class="card-body d-flex gap-2 justify-content-between align-items-center p-3">
                        <button type="submit" class="btn btn-outline-success w-100" id="savePageBtn">
                            <i class="ri-save-line me-1"></i> Save
                        </button>
                        <button type="button" class="btn btn-outline-secondary w-100" id="saveAndExitBtn">
                            <i class="ri-logout-box-line me-1"></i> Save & Exit
                        </button>
                    </div>
                </div>

                <!-- Publish Options -->
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Publish Options</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="choices-status-input" class="form-label">Status</label>
                            <select class="form-select" name="status" id="choices-status-input" data-choices data-choices-search-false>
                                <option value="Published" {{ $content->status === 'Published' ? 'selected' : '' }}>Published</option>
                                <option value="Draft" {{ $content->status === 'Draft' ? 'selected' : '' }}>Draft</option>
                            </select>
                        </div>
                        <div>
                            <label for="choices-visibility-input" class="form-label">Visibility</label>
                            <select class="form-select" name="visibility" id="choices-visibility-input" data-choices data-choices-search-false>
                                <option value="Public" {{ $content->visibility === 'Public' ? 'selected' : '' }}>Public</option>
                                <option value="Hidden" {{ $content->visibility === 'Hidden' ? 'selected' : '' }}>Hidden</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Schedule -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Publish Schedule</h5>
                    </div>
                    <div class="card-body">
                        <div>
                            <label for="datepicker-publish-input" class="form-label">Publish Date & Time</label>
                            <input type="text" id="datepicker-publish-input" name="publish_at" class="form-control"
                                value="{{ $content->publish_at ? $content->publish_at->format('d.m.Y H:i') : '' }}"
                                placeholder="Select publish date"
                                data-provider="flatpickr"
                                data-date-format="d.m.y"
                                data-enable-time>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@if(session('success'))
<script>
    showToast("{{ session('success') }}", "success");
</script>
@endif

@endsection


@section('script')
    {{-- Load editor library --}}
    <script src="{{ asset('build/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>
    
    {{-- Set JS data before using it --}}
    <script>
        window.contentSections = @json($content->sections ?? []);
    </script>

<script src="{{ asset('js/modules/websitecontent/settings.js') }}"></script>
    
@endsection