

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-5">
                <div class="card-header"><h2>Health Officer Registration</h2></div>

                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('register')); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="form-group row">
                            <label for="healthOfficer_name" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Health Officer Name')); ?></label>

                            <div class="col-md-6">
                                <input id="healthOfficer_name" type="text" class="form-control <?php $__errorArgs = ['healthOfficer_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="healthOfficer_name" value="<?php echo e(old('healthOfficer_name')); ?>" required autocomplete="healthOfficer_name" autofocus>

                                <?php $__errorArgs = ['healthOfficer_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="hospitalGiven" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Hospital Allocated')); ?></label>

                            <div class="col-md-6">
                                <!--<input id="hospitalGiven" type="text" class="form-control <?php $__errorArgs = ['hospitalGiven'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="hospitalGiven" value="<?php echo e(old('hospitalGiven')); ?>" required autocomplete="hospitalGiven">-->
                                <select id="hospitalGiven" type="text" class="form-control select2 <?php $__errorArgs = ['hospitalGiven'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="hospitalGiven" value="<?php echo e(old('hospitalGiven')); ?>" required autocomplete="hospitalGiven" style="width: 100%;">
                                    <option selected="selected">Alabama</option>
                                    <option>Alaska</option>
                                    <option>California</option>
                                    <option>Delaware</option>
                                    <option>Tennessee</option>
                                    <option>Texas</option>
                                    <option>Washington</option>
                                </select>
                                <?php $__errorArgs = ['hospitalGiven'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="officerUsername" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Officer Username')); ?></label>

                            <div class="col-md-6">
                                <input id="officerUsername" type="text" class="form-control <?php $__errorArgs = ['officerUsername'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="officerUsername" required autocomplete="username" autofocus>

                                <?php $__errorArgs = ['officerUsername'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="registrationDate" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Registration Date')); ?></label>

                            <div class="col-md-6">
                                <input id="registrationDate" type="date" class="form-control <?php $__errorArgs = ['registrationDate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="registrationDate" required autocomplete="new-registrationDate">

                                <?php $__errorArgs = ['registrationDate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right"><?php echo e(__('Gender')); ?></label>
                            <div class="col-md-6">
                                <div class="form-check form-check-inline">
                                    <input id="gender" type="radio" class="form-check-input" name="gender" value="<?php echo e(old('gender')); ?>" checked>
                                    <label class="form-check-label" for="male">M</label>                                                                
                                </div>
                                <div class="form-check form-check-inline">
                                    <input id="gender" type="radio" class="form-check-input" name="gender" value="<?php echo e(old('gender')); ?>" >
                                    <label class="form-check-label" for="female">F</label>
                                </div> 
                            </div>                                             
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <?php echo e(__('Register')); ?>

                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.AdminLTE', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\DOC\Recess\Covid_casetool\resources\views/officerRegistration.blade.php ENDPATH**/ ?>