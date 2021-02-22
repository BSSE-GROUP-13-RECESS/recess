<?php $__env->startSection('content'); ?>
<!-- Main content -->
<section class="content-header">
  <div class="row">
    <div class="col-12">
      <div>
        <div class="card card-body">
          <h3 class="card-title">Patient list and total.</h3>
        </div>
        <div class="content">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <p>Total number of patients: <?php echo e($total); ?></p>
                    <?php if($total>0): ?>
                      <table id="patients_table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Patient name</th>
                            <th>Identification date</th>
                            <th>Gender</th>
                            <th>Category</th>
                            <th>Officer fullname</th>
                            <th>Hospital name</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($patient['patientId']); ?></td>
                                <td><?php echo e($patient['patientName']); ?></td>
                                <td><?php echo e($patient['dateOfId']); ?></td>
                                <td><?php echo e($patient['gender']); ?></td>
                                <td><?php echo e($patient['category']); ?></td>
                                <td><?php echo e($patient['fullName']); ?></td>
                                <td><?php echo e($patient['hospitalName']); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot>
                          <tr>
                              <th>Id</th>
                              <th>Patient name</th>
                              <th>Identification date</th>
                              <th>Gender</th>
                              <th>Category</th>
                              <th>Officer fullname</th>
                              <th>Hospital name</th>
                          </tr>
                          </tfoot>
                      </table>
                    <script type="text/javascript">
                        $(function () {
                            $("#patients_table").DataTable({
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


<?php echo $__env->make('layouts.adminLTE', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/timothy/Desktop/Covid_casetool/resources/views/patientlist.blade.php ENDPATH**/ ?>