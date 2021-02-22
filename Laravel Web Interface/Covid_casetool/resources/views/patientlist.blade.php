@extends('layouts.adminLTE')

@section('content')
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
                    <p>Total number of patients: {{ $total }}</p>
                    @if($total>0)
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
                        @foreach($patients as $patient)
                            <tr>
                                <td>{{ $patient['patientId'] }}</td>
                                <td>{{ $patient['patientName'] }}</td>
                                <td>{{ $patient['dateOfId'] }}</td>
                                <td>{{ $patient['gender'] }}</td>
                                <td>{{ $patient['category'] }}</td>
                                <td>{{ $patient['fullName'] }}</td>
                                <td>{{ $patient['hospitalName'] }}</td>
                            </tr>
                        @endforeach
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
                    @else
                      No data to display
                    @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

