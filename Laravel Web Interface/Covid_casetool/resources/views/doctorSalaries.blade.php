@extends('layouts.adminLTE')

@section('content')
  <!-- Main content -->
  <section class="content-header">
    <div class="row">
      <div class="col-12">
        <div>
          <div class="card card-body">
            <h3 class="card-title">Doctor Payments.</h3>
          </div>
          <div class="content">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <!-- /.card-header -->
                  <div class="card-body">
                    <p>Total number of rows: {{ $total_doc }}</p>
                    @if($total_doc>0)
                      <table id="doc_table" class="table table-bordered table-striped dtr-inline">
                        <thead>
                        <tr>
                          <th>Date</th>
                          <th>Username</th>
                          <th>Doctor's name</th>
                          <th>Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($doctorSalaries as $salary)
                          <tr>
                            <td>{{ $salary['date'] }}</td>
                            <td>{{ $salary['doctor'] }}</td>
                            <td>{{ $salary['fullName'] }}</td>
                            <td>{{ $salary['amount'] }}</td>
                          </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                          <th>Date</th>
                          <th>Username</th>
                          <th>Doctor's name</th>
                          <th>Amount</th>
                        </tr>
                        </tfoot>
                      </table>
                      <script type="text/javascript">
                          $(function () {
                              $("#doc_table").DataTable({
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

