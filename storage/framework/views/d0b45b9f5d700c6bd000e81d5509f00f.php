<?php
    $user = Auth::user();
    $unreadNotifications = $user->unreadNotifications;
    $unreadCount = $unreadNotifications->count();
?>

<div class="dropdown topbar-head-dropdown ms-1 header-item" id="notificationDropdown">
    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
            id="page-header-notifications-dropdown"
            data-bs-toggle="dropdown"
            data-bs-auto-close="outside"
            aria-haspopup="true"
            aria-expanded="false">
        <i class='bx bx-bell fs-22'></i>
        <?php if($unreadCount > 0): ?>
            <span class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger" id="topbar-unread-count">
                <?php echo e($unreadCount); ?>

                <span class="visually-hidden">unread alerts</span>
            </span>
        <?php endif; ?>
    </button>

    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">
        <div class="dropdown-head bg-primary bg-pattern rounded-top">
            <div class="p-3">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="m-0 fs-16 fw-semibold text-white">Notifications</h6>
                    </div>
                    <div class="col-auto dropdown-tabs">
                        <span class="badge bg-light-subtle text-body fs-13"><?php echo e($unreadCount); ?> New</span>
                    </div>
                </div>
            </div>

            <div class="px-2 pt-2">
                <ul class="nav nav-tabs dropdown-tabs nav-tabs-custom" data-dropdown-tabs="true" role="tablist">
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link active" data-bs-toggle="tab" href="#all-noti-tab" role="tab">All (<?php echo e($unreadCount); ?>)</a>
                    </li>
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link" data-bs-toggle="tab" href="#messages-tab" role="tab">Messages</a>
                    </li>
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link" data-bs-toggle="tab" href="#alerts-tab" role="tab">Alerts</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="tab-content position-relative" id="notificationItemsTabContent" style="min-height: 180px;">
            
            <div class="tab-pane fade show active py-2 ps-2" id="all-noti-tab" role="tabpanel">
                <div data-simplebar style="max-height: 300px;" class="pe-2">
                    <?php
                        $notifications = $user->notifications()->latest()->take(10)->get();
                    ?>

                    <?php $__empty_1 = true; $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $noti): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php
                            $data = $noti->data ?? [];
                            $from = \App\Models\User::find($data['from_user_id'] ?? null);
                            $fromName = $from ? $from->first_name . ' ' . $from->last_name : 'Someone';
                        ?>
                        <div class="text-reset notification-item d-block dropdown-item position-relative" data-notification-id="<?php echo e($noti->id); ?>">
                            <button class="btn btn-sm btn-icon btn-light text-muted position-absolute top-0 end-0 m-1 btn-close-notification" data-id="<?php echo e($noti->id); ?>">
                                <i class="ri-close-line"></i>
                            </button>
                            <div class="d-flex align-items-start pe-4">
                                <div class="avatar-xs me-3 flex-shrink-0">
                                    <?php if($from && $from->avatar): ?>
                                        <img src="<?php echo e(asset('storage/' . $from->avatar)); ?>" class="rounded-circle avatar-xs" alt="avatar">
                                    <?php else: ?>
                                        <span class="avatar-title bg-info-subtle text-info rounded-circle fs-16">
                                            <i class="<?php echo e($data['icon'] ?? 'bx bx-bell'); ?>"></i>
                                        </span>
                                    <?php endif; ?>
                                </div>

                                <div class="flex-grow-1">
                                    <h6 class="mt-0 mb-2 lh-base"><?php echo $data['title'] ?? ($fromName . ' sent you a request'); ?></h6>
                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <p class="mb-0 text-muted fs-11">
                                            <i class="mdi mdi-clock-outline"></i> <?php echo e(\Illuminate\Support\Str::replaceLast(' ago', '', $noti->created_at->diffForHumans())); ?>

                                        </p>
                                    
                                        <?php if(($data['type'] ?? null) === 'connection_request'): ?>
                                            <div class="d-flex gap-2">
                                                <button class="btn btn-sm btn-soft-success btn-accept"
                                                    data-id="<?php echo e($noti->data['connection_id'] ?? 'MISSING_ID'); ?>">
                                                    Accept
                                                </button>
                                                <button class="btn btn-sm btn-soft-danger btn-deny"
                                                    data-id="<?php echo e($noti->data['connection_id'] ?? ''); ?>">
                                                    Deny
                                                </button>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="text-center text-muted py-4">
                            <i class="ri-notification-off-line fs-24 mb-2"></i>
                            <p class="mb-0">No notifications yet</p>
                        </div>
                    <?php endif; ?>

                    <div class="my-3 text-center view-all">
                        <a href="<?php echo e(route('notifications.alerts')); ?>" class="btn btn-soft-success waves-effect waves-light">
                            View All Notifications <i class="ri-arrow-right-line align-middle"></i>
                        </a>
                    </div>
                </div>
            </div>

            
            <div class="tab-pane fade py-2 ps-2 text-center text-muted" id="messages-tab" role="tabpanel">
                <div class="p-4">
                    <i class="ri-message-2-line fs-24 d-block mb-2"></i>
                    <p>No messages yet. Coming soon.</p>
                </div>
            </div>

            
            <div class="tab-pane fade py-2 ps-2" id="alerts-tab" role="tabpanel">
                <div data-simplebar style="max-height: 300px;" class="pe-2">
                    <?php
                        $alerts = $notifications->filter(fn($n) => ($n->data['type'] ?? null) === 'connection_request');
                    ?>

                    <?php $__empty_1 = true; $__currentLoopData = $alerts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $noti): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php
                            $data = $noti->data ?? [];
                            $from = \App\Models\User::find($data['from_user_id'] ?? null);
                            $fromName = $from ? $from->first_name . ' ' . $from->last_name : 'Someone';
                        ?>
                        <div class="text-reset notification-item d-block dropdown-item position-relative" data-notification-id="<?php echo e($noti->id); ?>">
                            <button class="btn btn-sm btn-icon btn-light text-muted position-absolute top-0 end-0 m-1 btn-close-notification" data-id="<?php echo e($noti->id); ?>">
                                <i class="ri-close-line"></i>
                            </button>
                            <div class="d-flex align-items-start pe-4">
                                <div class="avatar-xs me-3 flex-shrink-0">
                                    <?php if($from && $from->avatar): ?>
                                        <img src="<?php echo e(asset('storage/' . $from->avatar)); ?>" class="rounded-circle avatar-xs" alt="avatar">
                                    <?php else: ?>
                                        <span class="avatar-title bg-warning-subtle text-warning rounded-circle fs-16">
                                            <i class="<?php echo e($data['icon'] ?? 'bx bx-user-plus'); ?>"></i>
                                        </span>
                                    <?php endif; ?>
                                </div>

                                <div class="flex-grow-1">
                                    <h6 class="mt-0 mb-2 lh-base"><?php echo $data['title'] ?? ($fromName . ' sent you a request'); ?></h6>
                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <p class="mb-0 text-muted fs-11">
                                            <i class="mdi mdi-clock-outline"></i> <?php echo e(\Illuminate\Support\Str::replaceLast(' ago', '', $noti->created_at->diffForHumans())); ?>

                                        </p>
                                    
                                        <?php if(($data['type'] ?? null) === 'connection_request'): ?>
                                            <div class="d-flex gap-2">
                                                <button class="btn btn-sm btn-soft-success btn-accept"
                                                    data-id="<?php echo e($noti->data['connection_id'] ?? 'MISSING_ID'); ?>">
                                                    Accept
                                                </button>
                                                <button class="btn btn-sm btn-soft-danger btn-deny"
                                                    data-id="<?php echo e($noti->data['connection_id'] ?? ''); ?>">
                                                    Deny
                                                </button>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="text-center text-muted py-4">
                            <i class="ri-notification-off-line fs-24 mb-2"></i>
                            <p class="mb-0">No alerts yet</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            
            <div class="notification-actions" id="notification-actions">
                <div class="d-flex text-muted justify-content-center">
                    Select <div id="select-content" class="text-body fw-semibold px-1">0</div> Result
                    <button type="button" class="btn btn-link link-danger p-0 ms-3" data-bs-toggle="modal" data-bs-target="#removeNotificationModal">Remove</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /Users/luk/Desktop/WORKSPACE/WBHUB_V1/Modules/Notifications/Resources/views/partials/topbar.blade.php ENDPATH**/ ?>