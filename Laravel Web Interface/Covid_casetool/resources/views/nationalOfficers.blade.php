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
                  <h4>Covid-19 Consultants</h4>
                  <p>Total number of Officers: {{ $total_con }}</p>
                  @if($total_con>0)
                    <table id="cons_table" class="table table-bordered table-striped dtr-inline">
                      <thead>
                      <tr>
                        <th>Officer username</th>
                        <th>Officer fullname</th>
                        <th>Hospital name</th>
                        <th>Position</th>
                      </tr>
                      </thead>
                      <tbody>
                      @foreach($consultants as $consultant)
                        <tr>
                          <td>{{ $consultant['username'] }}</td>
                          <td>{{ $consultant['fullName'] }}</td>
                          <td>{{ $consultant['hospitalName'] }}</td>
                          <td>{{ $consultant['position'] }}</td>
                        </tr>
                      @endforeach
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>Officer username</th>
                        <th>Officer fullname</th>
                        <th>Hospital name</th>
                        <th>Position</th>
                      </tr>
                      </tfoot>
                    </table>
                    <script type="text/javascript">
                        $(function () {
                            $("#cons_table").DataTable({
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