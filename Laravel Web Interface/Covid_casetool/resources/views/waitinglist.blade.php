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
                <form class="card-body" method="get" action="{{ route('registerPosition') }}">
                  <h4>Consultant Waiting List</h4>
                  <p>Total number of Officers: {{ $total_cons }}</p>
                  @if($total_cons>0)
                    <table id="cons_table" class="table table-bordered table-striped dtr-inline">
                      <thead>
                      <tr>
                        <th>Officer username</th>
                        <th>Position</th>
                      </tr>
                      </thead>
                      <tbody>
                      @foreach($Wconsultants as $consultant)
                        <tr>
                          <td>{{ $consultant['username'] }}</td>
                          <td><label for="{{ $consultant['username'] }}"></label><input type="text" name="{{ $consultant['username'] }}" id="{{ $consultant['username'] }}" class="pos" width="80%"></td>
                        </tr>
                      @endforeach
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
                  @else
                    No data to display
                  @endif
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection