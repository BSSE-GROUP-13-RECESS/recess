

<?php $__env->startSection('content'); ?>
  <section class="content-header">
    <div class="row">
      <div class="col-12">
        <div class="content">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <!-- /.card-header -->
                <form class="card-body" method="get" action="<?php echo e(route('registerPosition')); ?>">
                  <h4>Consultant Waiting List</h4>
                  <p>Total number of Officers: <?php echo e($total_cons); ?></p>
                  <?php if($total_cons>0): ?>
                    <table id="cons_table" class="table table-bordered table-striped dtr-inline">
                      <thead>
                      <tr>
                        <th>Officer username</th>
                        <th>Position</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php $__currentLoopData = $Wconsultants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $consultant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td><?php echo e($consultant['username']); ?></td>
                          <td><label for="<?php echo e($consultant['username']); ?>"></label><input type="text" name="<?php echo e($consultant['username']); ?>" id="<?php echo e($consultant['username']); ?>" class="pos" width="80%"></td>
                        </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>Officer username</th>
                        <th>Position</th>
                      </tr>
                      </tfoot>
                    </table>
                    <input type="submit" value="Submit" class="btn btn-outline-primary">
                    <script type="text/javascript">
                        $(function () {
                            $("#cons_table").DataTable({
                                "responsive": true,
                                "autoWidth": false,
                            });
                        });
                    </script>
                  <?php else: ?>
                    No data to display
                  <?php endif; ?>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.adminLTE', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/timothy/Desktop/Covid_casetool/resources/views/waitinglist.blade.php ENDPATH**/ ?>