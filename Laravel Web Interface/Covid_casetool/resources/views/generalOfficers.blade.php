@extends('layouts.adminLTE')

@section('content')
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
                    <p>Total number of Officers: {{ $total_hw }}</p>
                    @if($total_hw>0)
                      <table id="hworkers_table" class="table table-bordered table-striped dtr-inline dataTables_length">
                        <thead>
                        <tr>
                          <th>Officer username</th>
                          <th>Officer fullname</th>
                          <th>Hospital name</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($hworkers as $hworker)
                          <tr>
                            <td>{{ $hworker['username'] }}</td>
                            <td>{{ $hworker['fullName'] }}</td>
                            <td>{{ $hworker['hospitalName'] }}</td>
                          </tr>
                        @endforeach
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
  </section>

@endsection