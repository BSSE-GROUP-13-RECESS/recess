@extends('layouts.adminLTE')

@section('content')
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
                  <p>Total number of Officers: {{ $total_sen }}</p>
                  @if($total_sen>0)
                    <table id="sen_table" class="table table-bordered table-striped dtr-inline">
                      <thead>
                      <tr>
                        <th>Officer username</th>
                        <th>Officer fullname</th>
                        <th>Hospital name</th>
                      </tr>
                      </thead>
                      <tbody>
                      @foreach($seniors as $senior)
                        <tr>
                          <td>{{ $senior['username'] }}</td>
                          <td>{{ $senior['fullName'] }}</td>
                          <td>{{ $senior['hospitalName'] }}</td>
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
                            $("#sen_table").DataTable({
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