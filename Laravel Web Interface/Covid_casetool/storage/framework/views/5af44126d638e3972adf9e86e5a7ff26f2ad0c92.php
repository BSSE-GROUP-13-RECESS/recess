<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  <title>COVID-19 Case Management Tool</title>

  <link rel="stylesheet" href="<?php echo e(asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('favicon.png')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('plugins/chart.js/Chart.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('plugins/fontawesome-free/css/all.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('dist/css/adminlte.min.css')); ?>">

  <script src="<?php echo e(asset('jquery/dist/jquery.min.js')); ?>"></script>
  <script src="<?php echo e(asset('plugins/chart.js/Chart.min.js')); ?>"></script>
  <script src="<?php echo e(asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')); ?>"></script>
  <script src="<?php echo e(asset('DataTables/datatables.min.js')); ?>"></script>

</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo e('home'); ?>" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item" title="customize interface">
        <a class="nav-icon" data-widget="control-sidebar" data-slide="true" href="#"><i class="fas fa-user-edit"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo e('home'); ?>" class="brand-link">
      <img src="<?php echo e(asset('dist/img/coronavirus.svg')); ?>" alt="Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"><b style="color: red">COVID-19</b> Case Tool</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo e(asset('dist/img/user.svg')); ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a id="navbarDropdown" class="d-block" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            <?php echo e(Auth::user()->name); ?><br><em id="status">Administrator</em></a>
        </div>

      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
                <a href="<?php echo e(route('home')); ?>" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>Dashboard</p>
                </a>           
          </li>          
          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Charts
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo e(Route('enrollment')); ?>" class="nav-link" onclick="f()">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Enrollment Figures (%)</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo e(Route('donations')); ?>" class="nav-link" onclick="select()">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Donations</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Hierarchy</p>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="nav-item has-treeview admin">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Forms
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo e(Route('directorRegistration')); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Director Registration</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo e(Route('officerRegistration')); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Officer Registration</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo e(Route('fundsRegistration')); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Funds</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Tables
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo e(route('patientlist')); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Patient List</p>
                </a>
              </li>
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Payments
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo e(route('staff_salaries')); ?>" class="nav-link">
                      <i class="far fa-plus-square nav-icon"></i>
                      <p>Staff</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo e(route('doctor_salaries')); ?>" class="nav-link">
                      <i class="far fa-plus-square nav-icon"></i>
                      <p>Health Workers</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item admin">
                <a href="<?php echo e(route('getlist')); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Waiting List</p>
                </a>
              </li>
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Health Officer List
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo e(route('covid19Health')); ?>" class="nav-link">
                      <i class="far fa-plus-square nav-icon"></i>
                      <p>General Hospital Officers</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href=" <?php echo e(route('seniors')); ?>" class="nav-link">
                      <i class="far fa-plus-square nav-icon"></i>
                      <p>Senior Covid-19 Health Officers</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo e(route('consultants')); ?>" class="nav-link">
                      <i class="far fa-plus-square nav-icon"></i>
                      <p>Covid-19 Consultants</p>
                    </a>
                  </li>         
                </ul>
              </li>
            </ul>
          </li>
          
          <li class="nav-item">
           <a class="nav-link" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
             <i class="fas fa-circle nav-icon"></i><p><?php echo e(__('Logout')); ?></p></a>
              <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                  <?php echo csrf_field(); ?>
              </form>
          </li>
        </ul>
      </nav>
    </div>
  </aside>
  <div class="content-wrapper">
    <?php echo $__env->yieldContent('content'); ?>  
  </div>
  <aside class="control-sidebar control-sidebar-dark">
  </aside>
  <footer class="main-footer">
    <strong>Copyright &copy; <b style="color:blue">Recess Group-13</b>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0
    </div>
  </footer>
</div>
<?php if(strlen(Auth::user()->director)>4): ?>
  <script>
    let admin = document.getElementsByClassName('admin');
    for(let i=0;i<admin.length;i++){
        admin[i].style.display = 'none';
    }
    document.getElementById('status').innerText = "Director";
  </script>
<?php endif; ?>

<script src="<?php echo e(asset('plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>

<script src="<?php echo e(asset('plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')); ?>"></script>

<!-- AdminLTE for demo purposes -->
<script src="<?php echo e(asset('dist/js/demo.js')); ?>"></script>

<script src="<?php echo e(asset('dist/js/adminlte.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/notify.min.js')); ?>"></script>

</body>
</html>
<?php /**PATH /home/timothy/Desktop/Covid_casetool/resources/views/layouts/adminLTE.blade.php ENDPATH**/ ?>