<?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
<div class="col-xl-3 col-lg-4 col-sm-6">
    <div class="ribbon-box right">

        <div class="card user-card shadow-sm overflow-hidden position-relative" data-user-id="<?php echo e($user->id); ?>">

            <?php
                $connection = auth()->user()->receivedConnections()
                    ->where('user_id', $user->id)
                    ->where('status', 'pending')
                    ->first();
            
                $notification = auth()->user()->notifications()
                    ->where('data->connection_id', $connection?->id)
                    ->first();
            ?>
            
            <?php if($connection): ?>
                <div class="connection-banner position-absolute w-100 d-flex justify-content-between align-items-center ps-3 pe-2 py-2"
                    style="top: 0; left: 0; z-index: 2; background-color: rgba(63, 148, 121, 0.85);">
                    <strong class="text-white">Wants to Connect</strong>
                    <div>
                        <button class="btn btn-sm text-white me-1 btn-success deny-connection-btn"
                            style="border: 1px solid #fff;"
                            data-id="<?php echo e($connection->id); ?>"
                            <?php if($notification): ?> data-notification-id="<?php echo e($notification->id); ?>" <?php endif; ?>>
                            Deny
                        </button>
                        <button class="btn btn-sm text-white btn-success accept-connection-btn"
                            style="border: 1px solid #fff;"
                            data-id="<?php echo e($connection->id); ?>"
                            <?php if($notification): ?> data-notification-id="<?php echo e($notification->id); ?>" <?php endif; ?>>
                            Accept
                        </button>
                    </div>
                </div>
            <?php endif; ?>

            <?php $status = $user->regionStatus(); ?>

            <?php if($status === 'local'): ?>
                <div class="ribbon ribbon-success">Local</div>
            <?php else: ?>
                <div class="ribbon ribbon-secondary">Visitor</div>
            <?php endif; ?>

            <div style="height: 100px; overflow: hidden;">
                <img src="<?php echo e($user->cover_photo ? asset('storage/' . $user->cover_photo) : asset('build/images/profile-bg.jpg')); ?>"
                    class="img-fluid w-100"
                    style="object-fit: cover; object-position: center;">
            </div>

            <div class="card-body text-center pt-4">

                <div class="mx-auto mb-3"
                    style="width: 80px; height: 80px; border-radius: 50%; margin-top: -60px;
                        overflow: hidden; background-image: url('<?php echo e($user->avatar ? asset('storage/' . $user->avatar) : asset('build/images/users/avatar-1.jpg')); ?>');
                        background-size: cover; background-position: center; background-color: #fff;
                        border: 3px solid #fff; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
                </div>

                <h5 class="fs-16 mb-0"><?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?></h5>

                <?php if(!empty($user->title)): ?>
                    <p class="fw-semibold text-primary small mb-1"><?php echo e($user->title); ?></p>
                <?php endif; ?>

                <p class="text-muted small fst-italic mb-2">
                    <?php echo e(Str::limit($user->bio ?? 'No bio provided.', 80)); ?>

                </p>

                <div class="d-flex justify-content-center gap-2 mt-3">


                    <a href="<?php echo e(route('profile.show', $user->id)); ?>" class="btn btn-sm btn-outline-primary">
                        <i class="ri-eye-line me-1"></i>View
                    </a>
                    

                    <?php if(auth()->id() !== $user->id): ?>
                    <?php
                    $isFollowing = auth()->user()->isFollowing($user);
                ?>
                
                <button type="button"
                    class="btn btn-sm btn-outline-success <?php echo e($isFollowing ? 'following-btn' : 'follow-btn'); ?>"
                    data-id="<?php echo e($user->id); ?>"
                    style="min-width: 100px; padding: 0.25rem 0.5rem;">
                    <?php echo $isFollowing
                        ? '<i class="ri-user-follow-line align-bottom"></i> Following'
                        : '<i class="ri-user-follow-line align-bottom"></i> Follow'; ?>

                </button>

                        <?php
                            $auth = auth()->user();
                            $isConnected = $auth->isConnectedWith($user);
                            $hasPendingSent = $auth->hasPendingConnectionWith($user);
                            $hasPendingReceived = $connection !== null;
                        ?>

                        <?php if($isConnected): ?>
                            <button class="btn btn-sm btn-secondary" disabled>
                                <i class="ri-link align-bottom"></i> Connected
                            </button>
                        <?php elseif($hasPendingSent || $hasPendingReceived): ?>
                        <button class="btn btn-sm btn-outline-warning pending-connection-btn" disabled data-id="<?php echo e($user->id); ?>"
                            style="min-width: 100px; text-align:left;">
                            <i class="ri-time-line align-bottom me-1"></i>
                            <span class="pending-text">Connection</span>
                        </button>
                        <?php else: ?>
                            <button class="btn btn-sm btn-outline-info connect-btn" data-id="<?php echo e($user->id); ?>">
                                <i class="ri-link align-bottom"></i> Connect
                            </button>
                        <?php endif; ?>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
<div class="col-12">
    <div class="alert alert-warning text-center">
        No users found.
    </div>
</div>
<?php endif; ?><?php /**PATH /Users/luk/Desktop/WORKSPACE/WBHUB_V1/Modules/Users/Resources/views/partials/_user_cards.blade.php ENDPATH**/ ?>