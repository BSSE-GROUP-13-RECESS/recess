<?php $__env->startSection('content'); ?>
  <!-- Main content -->
  <section class="content-header">
    <div class="row">
      <div class="col-12">
        <div class="content">
          <div class="card card-body">
            <h3 class="card-title">Staff Salaries.</h3>
          </div>
          <div>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <p>Total number of rows: <?php echo e($total_rw); ?></p>
                    <?php if($total_rw>0): ?>
                      <table id="salary_table" class="table table-bordered table-striped dtr-inline">
                        <thead>
                        <tr>
                          <th>Date</th>
                          <th>Username</th>
                          <th>Fullname</th>
                          <th>Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $staffSalaries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $salary): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <tr>
                            <td><?php echo e($salary['date']); ?></td>
                            <td><?php echo e($salary['staffUsername']); ?></td>
                            <td><?php echo e($salary['staffFullName']); ?></td>
                            <td><?php echo e($salary['amount']); ?></td>
                          </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot>
                          <tr>
                            <th>Date</th>
                            <th>Username</th>
                            <th>Fullname</th>
                            <th>Amount</th>
                          </tr>
                        </tfoot>
                      </table>
                      <script type="text/javascript">
                          $(function () {
                              $("#salary_table").DataTable({
                                  "responsive": true,
                                  "autoWidth": false,
                              });
                          });
                      </script>
                    <?php else: ?>
                      No data to display
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.adminLTE', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/timothy/Desktop/Covid_casetool/resources/views/staffSalaries.blade.php ENDPATH**/ ?>