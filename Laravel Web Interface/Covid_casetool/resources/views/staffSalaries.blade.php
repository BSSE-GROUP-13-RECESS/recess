@extends('layouts.adminLTE')

@section('content')
  <!-- Main content -->
  <section class="content-header">
    <div class="row">
      <div class="col-12">
        <div class="content">
          <div class="card card-body">
            <h3 class="card-title">Staff Salaries.</h3>
          </div>
          <div>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <p>Total number of rows: {{ $total_rw }}</p>
                    @if($total_rw>0)
                      <table id="salary_table" class="table table-bordered table-striped dtr-inline">
                        <thead>
                        <tr>
                          <th>Date</th>
                          <th>Username</th>
                          <th>Fullname</th>
                          <th>Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($staffSalaries as $salary)
                          <tr>
                            <td>{{ $salary['date'] }}</td>
                            <td>{{ $salary['staffUsername'] }}</td>
                            <td>{{ $salary['staffFullName'] }}</td>
                            <td>{{ $salary['amount'] }}</td>
                          </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                          <tr>
                            <th>Date</th>
                            <th>Username</th>
                            <th>Fullname</th>
                            <th>Amount</th>
                          </tr>
                        </tfoot>
                      </table>
                      <script type="text/javascript">
                          $(function () {
                              $("#salary_table").DataTable({
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


