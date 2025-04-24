<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.signup'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg"  id="auth-particles">
            <div class="bg-overlay"></div>
    
            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="index" class="d-inline-block auth-logo">
                                    <img src="<?php echo e(URL::asset('build/images/big-logo.png')); ?>" alt="" height="130">
                                </a>
                            </div>
                        <p class="mt-3 fs-15 fw-medium">Connecting businesses in the Whitsundays</p>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">

                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Create New Account</h5>
                                    <p class="text-muted">Empower your business with digital control and network with fellow businesses across our beautiful region</p>
                                </div>
                                <div class="p-2 mt-4">
                                    <form class="row gx-3 gy-1 needs-validation" novalidate method="POST" action="<?php echo e(route('register')); ?>" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                    
                                        <div class="col-12 col-md-6 mb-3">
                                            <label class="form-label">First Name <span class="text-danger">*</span></label>
                                            <input type="text" name="first_name" class="form-control <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('first_name')); ?>" required>
                                            <div class="invalid-feedback"><?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div>
                                        </div>
                                    
                                        <div class="col-12 col-md-6 mb-3">
                                            <label class="form-label">Last Name <span class="text-danger">*</span></label>
                                            <input type="text" name="last_name" class="form-control <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('last_name')); ?>" required>
                                            <div class="invalid-feedback"><?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div>
                                        </div>
                                    
                                        <div class="col-12 mb-3">
                                            <label class="form-label">Email <span class="text-danger">*</span></label>
                                            <input type="email" name="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('email')); ?>" required>
                                            <div class="invalid-feedback"><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div>
                                        </div>
                                    
                                        <div class="col-12 mb-3">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label class="form-label">Password <span class="text-danger">*</span></label>
                                                    <input type="password" name="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                                    <input type="password" name="password_confirmation" class="form-control <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                                </div>
                                            </div>
                                            <div class="invalid-feedback mt-2" id="password-error">
                                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><?php echo e($message); ?><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                    
                                        
                                    
                                        <div class="col-12 mb-3">
                                            <p class="fs-12 text-muted fst-italic">
                                                By registering you agree to the WBHub <a href="#" class="text-primary text-decoration-underline">Terms of Use</a>
                                            </p>
                                        </div>
                                    
                                        <div class="col-12 mb-3">
                                            <button type="submit" class="btn btn-success w-100">Sign Up</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        <div class="mt-4 text-center">
                            <p class="mb-0">Already have an account ? <a href="<?php echo e(route('login')); ?>"
                                    class="fw-semibold text-primary text-decoration-underline"> Sign in </a> </p>
                        </div>

                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-muted">&copy; <script>document.write(new Date().getFullYear())</script> WBHub - Brought to you by Whitsunday Web</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const rules = {
            first_name: {
                el: document.querySelector('input[name="first_name"]'),
                test: v => v.trim() !== '',
                message: 'First name is required'
            },
            last_name: {
                el: document.querySelector('input[name="last_name"]'),
                test: v => v.trim() !== '',
                message: 'Last name is required'
            },
            email: {
                el: document.querySelector('input[name="email"]'),
                test: v => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v),
                message: 'Enter a valid email address'
            },
            password: {
                el: document.querySelector('input[name="password"]'),
                test: v => /^(?=.*[A-Z])(?=.*\d).{8,}$/.test(v),
                message: 'Password must be ≥8 characters, include 1 uppercase & 1 number'
            },
            password_confirmation: {
                el: document.querySelector('input[name="password_confirmation"]'),
                test: v => v === document.querySelector('input[name="password"]').value,
                message: 'Passwords do not match'
            }
        };
    
        Object.entries(rules).forEach(([name, { el, test, message }]) => {
            el.addEventListener('input', () => {
                const isValid = test(el.value);
                el.classList.toggle('is-valid', isValid);
                el.classList.toggle('is-invalid', !isValid);
    
                let feedback;
                if (name === 'password' || name === 'password_confirmation') {
                    // Toggle invalid on both password fields
                    document.querySelector('input[name="password"]').classList.toggle('is-invalid', !isValid);
                    document.querySelector('input[name="password_confirmation"]').classList.toggle('is-invalid', !isValid);
                    feedback = document.getElementById('password-error');
                } else {
                    feedback = el.closest('.mb-3').querySelector('.invalid-feedback');
                }
    
                feedback.classList.toggle('d-block', !isValid);
                feedback.textContent = isValid ? '' : message;
            });
        });
    
        <?php if($errors->any()): ?>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                Toast.fire({ icon: 'error', title: '<?php echo $error; ?>' });
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    });
    </script>
<script>
    <?php if($errors->any()): ?>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            Toast.fire({icon:'error',title:'<?php echo $error; ?>'});
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    </script>
<script src="<?php echo e(URL::asset('build/libs/particles.js/particles.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/js/pages/particles.app.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/js/pages/password-addon.init.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master-without-nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/luk/Desktop/WORKSPACE/WBHUB_V1/resources/views/auth/register.blade.php ENDPATH**/ ?>