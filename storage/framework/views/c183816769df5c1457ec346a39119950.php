<?php $__env->startSection('title'); ?> Edit Website Page <?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link href="<?php echo e(URL::asset('build/libs/dropzone/dropzone.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
    <?php $__env->slot('li_1'); ?> Website <?php $__env->endSlot(); ?>
    <?php $__env->slot('title'); ?> Edit Page <?php $__env->endSlot(); ?>
<?php echo $__env->renderComponent(); ?>

<form id="editpage-form"
      method="POST"
      action="<?php echo e(route('websitecontent.update', ['business' => $businessId, 'slug' => $slug])); ?>"
      enctype="multipart/form-data"
      class="needs-validation"
      novalidate>
    <?php echo csrf_field(); ?>
    <div class="row">
        <div class="col-lg-8">

            
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label" for="page-title-input">Page Title</label>
                        <input type="text" class="form-control" id="page-title-input" value="<?php echo e(ucfirst($slug)); ?>" readonly>
                    </div>

                    <?php $__currentLoopData = $content->sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="mb-4">
                            <label class="form-label"><?php echo e($section->title ?? 'Section ' . ($index + 1)); ?></label>
                            <div id="ckeditor-classic-<?php echo e($index); ?>" class="ckeditor-classic"></div>
                            <input type="hidden" name="sections[<?php echo e($index); ?>][content]" id="section-<?php echo e($index); ?>-input">
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Images</h5>
                </div>
                <div class="card-body">
                    <?php $__currentLoopData = $content->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="mb-4">
                            <h5 class="fs-14 mb-1"><?php echo e($image->title ?? 'Image ' . ($index + 1)); ?></h5>
                            <p class="text-muted">Upload an image.</p>

                            <div class="text-center">
                                <div class="position-relative d-inline-block">
                                    <div class="avatar-lg">
                                        <div class="avatar-title bg-light rounded">
                                            <img src="<?php echo e($image->url ?? ''); ?>" id="image-preview-<?php echo e($index); ?>" class="avatar-md h-auto" />
                                        </div>
                                    </div>
                                    <div class="position-absolute top-100 start-100 translate-middle">
                                        <label for="image-input-<?php echo e($index); ?>" class="mb-0" title="Select Image">
                                            <div class="avatar-xs">
                                                <div class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                                                    <i class="ri-image-fill"></i>
                                                </div>
                                            </div>
                                        </label>
                                        <input class="form-control d-none image-input"
                                               id="image-input-<?php echo e($index); ?>"
                                               name="images[<?php echo e($index); ?>][file]"
                                               type="file"
                                               accept="image/*">
                                    </div>
                                </div>
                            </div>

                            <input type="hidden"
                                   name="images[<?php echo e($index); ?>][url]"
                                   id="image-url-<?php echo e($index); ?>"
                                   value="<?php echo e($image->url ?? ''); ?>">
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    
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
                                <option value="Published" <?php echo e($content->status === 'Published' ? 'selected' : ''); ?>>Published</option>
                                <option value="Draft" <?php echo e($content->status === 'Draft' ? 'selected' : ''); ?>>Draft</option>
                            </select>
                        </div>
                        <div>
                            <label for="choices-visibility-input" class="form-label">Visibility</label>
                            <select class="form-select" name="visibility" id="choices-visibility-input" data-choices data-choices-search-false>
                                <option value="Public" <?php echo e($content->visibility === 'Public' ? 'selected' : ''); ?>>Public</option>
                                <option value="Hidden" <?php echo e($content->visibility === 'Hidden' ? 'selected' : ''); ?>>Hidden</option>
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
                                value="<?php echo e($content->publish_at ? $content->publish_at->format('d.m.Y H:i') : ''); ?>"
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

<?php if(session('success')): ?>
<script>
    showToast("<?php echo e(session('success')); ?>", "success");
</script>
<?php endif; ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
    
    <script src="<?php echo e(asset('build/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js')); ?>"></script>
    
    
    <script>
        window.contentSections = <?php echo json_encode($content->sections ?? [], 15, 512) ?>;
    </script>

<script src="<?php echo e(asset('js/modules/websitecontent/settings.js')); ?>"></script>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/luk/Desktop/WORKSPACE/WBHUB_V1/Modules/WebsiteContent/Resources/views/edit.blade.php ENDPATH**/ ?>