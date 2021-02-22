<?php $__env->startSection('content'); ?>
  <!-- /.content-wrapper -->
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-edit"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">OVERALL CASES</span>
                <span class="info-box-number" style="color:blue">
                  <?php echo e($ptotal); ?>

                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-head-side-cough"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">SYMPTOMATIC</span>
                <span class="description-percentage text-danger"><?php echo e($sper); ?>%</span>
                <span class="info-box-number" style="color:blue"><?php echo e($stotal); ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-head-side-cough-slash"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">ASYMPTOMATIC</span>
                <span class="description-percentage text-success"><?php echo e($aper); ?>%</span>
                <span class="info-box-number" style="color:blue"><?php echo e($atotal); ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-hand-holding-medical"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">COVID-19 DOCTORS</span>
                <span class="info-box-number" style="color:blue"><?php echo e($dtotal); ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Registry</h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                    <p class="text-center">
                      <small>Deaths & Recoveries During Lock Down: 1 Jan, 2020 - 30 Jul, 2020</small>
                    </p>

                    <div class="chart">
                      <!-- Sales Chart Canvas -->
                      <canvas id="salesChart" height="180" style="height: 180px;"></canvas>
                    </div>
                    <script>
                        $(function () {
                            'use strict'
                            // Get context with jQuery - using jQuery's .get() method.
                            var salesChartCanvas = $('#salesChart').get(0).getContext('2d')

                            var salesChartData = {
                                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                                datasets: [
                                    {
                                        label: 'Deaths',
                                        backgroundColor: 'rgba(60,141,188,0.9)',
                                        borderColor: 'rgba(60,141,188,0.8)',
                                        pointRadius: false,
                                        pointColor: '#3b8bba',
                                        pointStrokeColor: 'rgba(60,141,188,1)',
                                        pointHighlightFill: '#fff',
                                        pointHighlightStroke: 'rgba(60,141,188,1)',
                                        data: [28, 48, 40, 19, 30, 27, 40]
                                    },
                                    {
                                        label: 'Recoveries',
                                        backgroundColor: 'rgba(210, 214, 222, 1)',
                                        borderColor: 'rgba(210, 214, 222, 1)',
                                        pointRadius: false,
                                        pointColor: 'rgba(210, 214, 222, 1)',
                                        pointStrokeColor: '#c1c7d1',
                                        pointHighlightFill: '#fff',
                                        pointHighlightStroke: 'rgba(220,220,220,1)',
                                        data: [65, 59, 80, 81, 56, 55, 50]
                                    },
                                ]
                            }

                            var salesChartOptions = {
                                maintainAspectRatio: false,
                                responsive: true,
                                legend: {
                                    display: true
                                },
                                scales: {
                                    xAxes: [{
                                        gridLines: {
                                            display: false,
                                        }
                                    }],
                                    yAxes: [{
                                        gridLines: {
                                            display: false,
                                        }
                                    }]
                                }
                            }


                            // This will get the first returned node in the jQuery collection.
                            var salesChart = new Chart(salesChartCanvas, {
                                    type: 'line',
                                    data: salesChartData,
                                    options: salesChartOptions
                                }
                            );
                        })
                    </script>
                    <!-- /.chart-responsive -->
                  </div>
                  <!-- /.col -->
                  <div class="col-md-4">
                    <p class="text-center">
                      <strong>Achieved Goals</strong>
                    </p>

                    <div class="progress-group">
                      Test More People
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: 6%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->

                    <div class="progress-group">
                      Avail More Face Masks to the Public
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" style="width: 60%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      <span class="progress-text">Avail Sanitizers to the Public</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-success" style="width: 25%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      Set up More Covid-19 Health Centres
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-warning" style="width: 30%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- ./card-body -->
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-success"></i>----</span>
                      <h5 class="description-header"><?php echo e($funds); ?></h5>
                      <span class="description-text">TOTAL FUNDS</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-primary"><?php echo e($savp); ?>%</span>
                      <h5 class="description-header"><?php echo e($saved); ?></h5>
                      <span class="description-text">TOTAL SAVINGS</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage text-success"><?php echo e($spp); ?>%</span>
                      <h5 class="description-header"><?php echo e($spent); ?></h5>
                      <span class="description-text">TOTAL EXPENSE</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block">
                      <span class="description-percentage text-danger">HIGH PATIENT DOCTOR RATIO</span>
                      <h5 class="description-header">FEW RESOURCES AVAILABLE</h5>
                      <span class="description-text">CHALLENGES</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.adminLTE', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/timothy/Desktop/Covid_casetool/resources/views/home.blade.php ENDPATH**/ ?>