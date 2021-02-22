

<?php $__env->startSection('content'); ?>
    <!-- Main content -->
  <section class="content-header">
    <div class="row">
      <div class="col-12">
          <div class="content">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <!-- /.card-header -->
                  <div class="card-body">
                    <h4>General Hospital Officers</h4>
                    <p>Total number of Officers: <?php echo e($total_hw); ?></p>
                    <?php if($total_hw>0): ?>
                      <table id="hworkers_table" class="table table-bordered table-striped dtr-inline dataTables_length">
                        <thead>
                        <tr>
                          <th>Officer username</th>
                          <th>Officer fullname</th>
                          <th>Hospital name</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $hworkers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hworker): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <tr>
                            <td><?php echo e($hworker['username']); ?></td>
                            <td><?php echo e($hworker['fullName']); ?></td>
                            <td><?php echo e($hworker['hospitalName']); ?></td>
                          </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot>
                          <tr>
                            <th>Officer username</th>
                            <th>Officer fullname</th>
                            <th>Hospital name</th>
                          </tr>
                        </tfoot>
                      </table>
                      <script type="text/javascript">
                          $(function () {
                              $("#hworkers_table").DataTable({
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
  </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.adminLTE', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/timothy/Desktop/Covid_casetool/resources/views/generalOfficers.blade.php ENDPATH**/ ?>