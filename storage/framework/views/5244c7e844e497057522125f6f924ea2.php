<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.profile'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(URL::asset('build/libs/swiper/swiper-bundle.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="profile-foreground position-relative mx-n4 mt-n4">
    <div class="profile-wid-bg">
        <img src="<?php if($user->cover_photo): ?> <?php echo e(asset('storage/' . $user->cover_photo)); ?> <?php else: ?> <?php echo e(asset('build/images/profile-bg.jpg')); ?> <?php endif; ?>"
             alt="Cover Photo" class="profile-wid-img" />
    </div>
</div>

<div class="pt-4 mb-4 mb-lg-3 pb-lg-4 profile-wrapper">
    <div class="row g-4">
        <!-- Avatar -->
        <div class="col-auto">
            <div class="avatar-lg">
                <img src="<?php if($user->avatar): ?> <?php echo e(asset('storage/' . $user->avatar)); ?> <?php else: ?> <?php echo e(asset('build/images/users/avatar-1.jpg')); ?> <?php endif; ?>"
                    alt="user-img" class="img-thumbnail rounded-circle object-fit-cover" style="height:100px; width:100px;" />
            </div>
        </div>

        <!-- User Info -->
        <div class="col">
            <div class="p-2">
                <h3 class="text-white mb-1"><?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?></h3>
                <p class="text-white text-opacity-75"><?php echo e($user->role ?? 'Member'); ?></p>
                <div class="hstack text-white-50 gap-1">
                    <div class="me-2">
                        <i class="ri-map-pin-user-line me-1 text-white text-opacity-75 fs-16 align-middle"></i>
                        <?php echo e($user->suburb ?? 'Location Unknown'); ?>

                    </div>
                    <div>
                        <i class="ri-building-line me-1 text-white text-opacity-75 fs-16 align-middle"></i>
                        <?php echo e($user->company ?? 'WB Hub'); ?>

                    </div>
                </div>
            </div>
        </div>

        <!-- Stats -->
        <div class="col-12 col-lg-auto order-last order-lg-0">
            <div class="row text text-white-50 text-center">
                <div class="col-lg-6 col-4">
                    <div class="p-2">
                        <h4 class="text-white mb-1"><?php echo e($user->followers->count()); ?></h4>
                        <p class="fs-14 mb-0">Followers</p>
                    </div>
                </div>
                <div class="col-lg-6 col-4">
                    <div class="p-2">
                        <h4 class="text-white mb-1"><?php echo e($user->following->count()); ?></h4>
                                 <p class="fs-14 mb-0">Following</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="d-flex profile-wrapper">
            <!-- Nav tabs -->
            <ul class="nav nav-pills animation-nav profile-nav gap-2 gap-lg-3 flex-grow-1" role="tablist">
                <li class="nav-item">
                    <a class="nav-link fs-14 active" data-bs-toggle="tab" href="#overview-tab" role="tab">
                        <i class="ri-airplay-fill d-inline-block d-md-none"></i> 
                        <span class="d-none d-md-inline-block">Overview</span>
                    </a>
                </li>
                
            </ul>
            <?php
            $authUser = auth()->user();
            $isOwnProfile = $authUser && $authUser->id === $user->id;
            $isSuperadmin = $authUser && $authUser->hasRole('superadmin');
        
            $isFollowing = $authUser->isFollowing($user);
            $isConnected = $authUser->isConnectedWith($user);
            $hasPendingSent = $authUser->hasPendingConnectionWith($user);
            $hasPendingReceived = $authUser->receivedConnections()
                ->where('user_id', $user->id)
                ->where('status', 'pending')
                ->first();
        ?>
        
        <div class="d-flex flex-column align-items-end gap-2">
        
            <div class="d-flex gap-2 flex-wrap justify-content-end">
                <?php if($isOwnProfile || $isSuperadmin): ?>
                    <div class="flex-shrink-0">
                        <a href="<?php echo e(route('profile.settings')); ?>" class="btn btn-primary">
                            <i class="ri-edit-box-line align-bottom"></i> Edit Profile
                        </a>
                    </div>
                <?php endif; ?>
        
                <?php if(!$isOwnProfile || $isSuperadmin): ?>
                    
                    <div class="flex-shrink-0">
                        <button type="button"
                            class="btn btn-<?php echo e($isFollowing ? 'success following-btn' : 'outline-success follow-btn'); ?>"
                            data-id="<?php echo e($user->id); ?>"
                            style="min-width: 109px;">
                            <?php echo $isFollowing
                                ? '<i class="ri-user-follow-line align-bottom"></i> Following'
                                : '<i class="ri-user-follow-line align-bottom"></i> Follow'; ?>

                        </button>
                    </div>
        
                    
                    <div class="flex-shrink-0">
                        <?php if($isConnected): ?>
                            <button class="btn btn-secondary" disabled>
                                <i class="ri-user-shared-line align-bottom"></i> Connected
                            </button>
                        <?php elseif($hasPendingSent): ?>
                            <button class="btn btn-outline-warning pending-connection-btn" disabled data-id="<?php echo e($user->id); ?>"
                                style="min-width: 130px;">
                                <i class="ri-time-line align-bottom me-1"></i>
                                <span class="pending-text">Connection</span>
                            </button>
                            <?php elseif($hasPendingReceived): ?>
                            <div class="d-flex align-items-stretch connection-banner-row" style="min-width: 300px;">
                                <div class="btn btn-outline-secondary d-flex align-items-center fw-semibold rounded-0 rounded-start px-3">
                                    <?php echo e($user->first_name); ?> wants to connect
                                </div>
                        
                                <button class="btn btn-success accept-connection-btn rounded-0"
                                        data-id="<?php echo e($hasPendingReceived->id); ?>">
                                    <i class="ri-check-line align-bottom"></i>
                                </button>
                        
                                <button class="btn btn-danger deny-connection-btn rounded-0 rounded-end"
                                        data-id="<?php echo e($hasPendingReceived->id); ?>">
                                    <i class="ri-close-line align-bottom"></i>
                                </button>
                            </div>
                            <div class="connection-button-container"></div>
                        <?php else: ?>
                            <button class="btn btn-outline-info connect-btn" data-id="<?php echo e($user->id); ?>">
                                <i class="ri-user-add-line align-bottom"></i> Connect
                            </button>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        </div>
    </div>
</div>
                <!-- Tab panes -->
                <div class="tab-content pt-4 text-muted">
                    <div class="tab-pane active" id="overview-tab" role="tabpanel">
                        <div class="row">
                            <div class="col-xxl-3">
                                <?php if(auth()->id() === $user->id): ?>
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title mb-4">Complete Your Profile</h5>
                                        <div class="progress animated-progress custom-progress progress-label">
                                            <div class="progress-bar bg-success" role="progressbar" 
                                                style="width: <?php echo e($user->profileCompletionPercent()); ?>%" 
                                                aria-valuenow="<?php echo e($user->profileCompletionPercent()); ?>" 
                                                aria-valuemin="0" aria-valuemax="100">
                                                <div class="label"><?php echo e($user->profileCompletionPercent()); ?>%</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                                <div class="card text-white">
                                    <div class="card-body pb-0">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h5 class="card-title mb-0 text-white">Profile Information</h5>
                                            <span class="badge bg-secondary fs-12">
                                                Joined <?php echo e($user->created_at->format('M Y')); ?>

                                            </span>
                                        </div>
                                
                                        <ul class="list-group list-group-flush border-top pt-3">
                                            <li class="list-group-item text-white border-0 px-0 d-flex justify-content-between align-items-center">
                                                <span class="fw-semibold text-white-50">Name</span>
                                                <span><?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?></span>
                                            </li>
                                            <li class="list-group-item text-white border-0 px-0 d-flex justify-content-between align-items-center">
                                                <span class="fw-semibold text-white-50">Email</span>
                                                <span><?php echo e($user->email); ?></span>
                                            </li>
                                            <?php
                                            $status = $user->regionStatus();
                                        ?>
                             
                                        </ul>
                                    </div>
                                </div>

                                <?php if (isset($component)) { $__componentOriginald78668ee3adca9356118d3ca8eaac22e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald78668ee3adca9356118d3ca8eaac22e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cards.map-location','data' => ['user' => $user]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('cards.map-location'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['user' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($user)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald78668ee3adca9356118d3ca8eaac22e)): ?>
<?php $attributes = $__attributesOriginald78668ee3adca9356118d3ca8eaac22e; ?>
<?php unset($__attributesOriginald78668ee3adca9356118d3ca8eaac22e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald78668ee3adca9356118d3ca8eaac22e)): ?>
<?php $component = $__componentOriginald78668ee3adca9356118d3ca8eaac22e; ?>
<?php unset($__componentOriginald78668ee3adca9356118d3ca8eaac22e); ?>
<?php endif; ?>

                                <?php if (isset($component)) { $__componentOriginal226438971ebd2e3348177d594a3af1e7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal226438971ebd2e3348177d594a3af1e7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cards.user-socials','data' => ['user' => $user]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('cards.user-socials'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['user' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($user)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal226438971ebd2e3348177d594a3af1e7)): ?>
<?php $attributes = $__attributesOriginal226438971ebd2e3348177d594a3af1e7; ?>
<?php unset($__attributesOriginal226438971ebd2e3348177d594a3af1e7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal226438971ebd2e3348177d594a3af1e7)): ?>
<?php $component = $__componentOriginal226438971ebd2e3348177d594a3af1e7; ?>
<?php unset($__componentOriginal226438971ebd2e3348177d594a3af1e7); ?>
<?php endif; ?>

                                <?php if (isset($component)) { $__componentOriginal81e4c6bea783519d8411a86dc133440a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal81e4c6bea783519d8411a86dc133440a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cards.user-connections','data' => ['user' => $user]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('cards.user-connections'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['user' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($user)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal81e4c6bea783519d8411a86dc133440a)): ?>
<?php $attributes = $__attributesOriginal81e4c6bea783519d8411a86dc133440a; ?>
<?php unset($__attributesOriginal81e4c6bea783519d8411a86dc133440a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal81e4c6bea783519d8411a86dc133440a)): ?>
<?php $component = $__componentOriginal81e4c6bea783519d8411a86dc133440a; ?>
<?php unset($__componentOriginal81e4c6bea783519d8411a86dc133440a); ?>
<?php endif; ?>

                              
                            </div>
                            <!--end col-->
                            <div class="col-xxl-9">
                                <div class="card border shadow-sm text-white">
                                    <div class="card-body position-relative">
                                        <div class="d-flex align-items-center mb-3">
                                            <h5 class="card-title mb-0 text-white">
                                                <i class="ri-user-voice-line me-2 text-primary"></i> About
                                            </h5>
                                            <span class="badge bg-dark-subtle text-white-50 ms-auto">Profile Bio</span>
                                        </div>
                                
                                        <?php if(!empty($user->bio)): ?>
                                            <blockquote class="blockquote custom-quote p-3 rounded bg-dark bg-opacity-10 text-white-50 mb-0">
                                                <p class="mb-0 fst-italic">“<?php echo e($user->bio); ?>”</p>
                                            </blockquote>
                                        <?php else: ?>
                                            <div class="text-center py-4">
                                                <div class="avatar-md mx-auto mb-3">
                                                    <span class="avatar-title bg-light text-muted rounded-circle fs-24">
                                                        <i class="ri-user-line"></i>
                                                    </span>
                                                </div>
                                                <p class="mb-0 text-muted fst-italic">No bio provided yet.</p>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <?php if (isset($component)) { $__componentOriginalaf19b96ccd9a0ab3cda0344b985591ef = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalaf19b96ccd9a0ab3cda0344b985591ef = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cards.user-businesses','data' => ['user' => $user]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('cards.user-businesses'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['user' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($user)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalaf19b96ccd9a0ab3cda0344b985591ef)): ?>
<?php $attributes = $__attributesOriginalaf19b96ccd9a0ab3cda0344b985591ef; ?>
<?php unset($__attributesOriginalaf19b96ccd9a0ab3cda0344b985591ef); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalaf19b96ccd9a0ab3cda0344b985591ef)): ?>
<?php $component = $__componentOriginalaf19b96ccd9a0ab3cda0344b985591ef; ?>
<?php unset($__componentOriginalaf19b96ccd9a0ab3cda0344b985591ef); ?>
<?php endif; ?>
                                <?php if (isset($component)) { $__componentOriginalbc004126bc3bc5ed531e5cec22824aa6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbc004126bc3bc5ed531e5cec22824aa6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.cards.user-posts','data' => ['user' => $user]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('cards.user-posts'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['user' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($user)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbc004126bc3bc5ed531e5cec22824aa6)): ?>
<?php $attributes = $__attributesOriginalbc004126bc3bc5ed531e5cec22824aa6; ?>
<?php unset($__attributesOriginalbc004126bc3bc5ed531e5cec22824aa6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbc004126bc3bc5ed531e5cec22824aa6)): ?>
<?php $component = $__componentOriginalbc004126bc3bc5ed531e5cec22824aa6; ?>
<?php unset($__componentOriginalbc004126bc3bc5ed531e5cec22824aa6); ?>
<?php endif; ?>
                               

                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>
                    
                    <!--end tab-pane-->
                </div>
                <!--end tab-content-->
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>

    <script>
        window.usersFollowUrl = <?php echo json_encode(route('users.toggle-follow'), 15, 512) ?>;
        window.usersConnectUrl = <?php echo json_encode(route('connections.send'), 15, 512) ?>;
        window.csrfToken = '<?php echo e(csrf_token()); ?>';
    </script>

    <script src="<?php echo e(URL::asset('build/libs/swiper/swiper-bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/modules/users/settings.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('build/js/pages/profile.init.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/luk/Desktop/WORKSPACE/WBHUB_V1/Modules/UserProfiles/resources/views/profile.blade.php ENDPATH**/ ?>