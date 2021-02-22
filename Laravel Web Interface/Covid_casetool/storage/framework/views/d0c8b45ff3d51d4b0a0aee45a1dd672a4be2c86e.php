

<?php $__env->startSection('content'); ?>
  <section class="content-header">
    <div class="row">
      <div class="col-12">
        <div class="content">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                  <h4>Senior Covid-19 Health Officers</h4>
                  <p>Total number of Officers: <?php echo e($total_sen); ?></p>
                  <?php if($total_sen>0): ?>
                    <table id="sen_table" class="table table-bordered table-striped dtr-inline">
                      <thead>
                      <tr>
                        <th>Officer username</th>
                        <th>Officer fullname</th>
                        <th>Hospital name</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php $__currentLoopData = $seniors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $senior): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td><?php echo e($senior['username']); ?></td>
                          <td><?php echo e($senior['fullName']); ?></td>
                          <td><?php echo e($senior['hospitalName']); ?></td>
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
                            $("#sen_table").DataTable({
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
<?php echo $__env->make('layouts.adminLTE', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/timothy/Desktop/Covid_casetool/resources/views/regionalOfficers.blade.php ENDPATH**/ ?>