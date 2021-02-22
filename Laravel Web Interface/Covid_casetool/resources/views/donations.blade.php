@extends('layouts.adminLTE')

@section('content')
  <div class="content-header">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-11">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Donations Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body form-inline">
                <form class="form-inline row">
                <label for="sele1" class="mr-sm-2"> Select by: </label><select id="sele1" onchange="select()" class="form-control col">
                  <option value="month">Month</option>
                  <option value="well-wisher">Well-wisher</option>
                </select>
                <label for="sele" class="mr-sm-2"> Select year: </label><select id="sele" onchange="select(this.value)" class="form-control col"></select>
                <label for="sele2" class="mr-sm-2" id="chng"> Select month: </label><select id="sele2" onchange="select('b')" class="form-control col"></select>
                </form>
                  <div>
                  @if($total_dona>0)
                    <p id="info1" hidden>{{json_encode($byMonth)}}</p>
                    <p id="info2" hidden>{{json_encode($byWell)}}</p>
                  @else
                    No data to display
                  @endif
                </div>
                <div class="chart">
                  <div id="ChartB"></div>
                  <script>
                      let infoMonth = JSON.parse(document.getElementById('info1').innerText);
                      let infoWell = JSON.parse(document.getElementById('info2').innerText);
                      let sele = document.getElementById('sele');
                      let sele2 = document.getElementById('sele2');

                      select();

                      function select(cValue="a") {
                          let selected = "";
                          let lab = document.getElementById('chng');
                          let choice = document.getElementById('sele1').value;
                          if (choice==='month'){
                              selected = infoMonth;
                              lab.innerText = "\tSelect month: ";
                          }else {
                              selected = infoWell;
                              lab.innerText = "\tSelect well-wisher: ";
                          }

                          if(cValue==="a") {
                              sele.innerHTML = "";
                              sele2.innerHTML = "";
                              for (let value in selected) {
                                  sele.innerHTML += "<option value="+ value +">" + value + "</option>";
                              }

                              for (let avalue in selected[sele.value]) {
                                  sele2.innerHTML += "<option value='"+avalue+"'>" + avalue + "</option>";
                              }
                          }else if(cValue!=="b"){
                              sele2.innerHTML = "";
                              for (let avalue in selected[cValue]) {
                                  sele2.innerHTML += "<option value='"+avalue+"'>" + avalue + "</option>";
                              }
                          }

                          drawDG(selected);
                      }

                      function drawDG(set) {
                          document.getElementById('ChartB').innerHTML ='<canvas id="myChartB" style="min-height: 400px; max-height: 80%; max-width: 100%;"></canvas>';
                          let ctx = document.getElementById('myChartB');
                          var labels, data_array, myChart, data;
                          let dt = document.getElementById('sele').value;
                          let dt1 = document.getElementById('sele2').value;
                          data = set[dt][dt1];
                          labels = data.labels;
                          data_array = data.dataArray;
                          let colors = [];
                          for(let i=0;i<data_array.length;i++){
                              colors.push(generateColor());
                          }
                          myChart = new Chart(ctx, {
                              type: 'pie',
                              responsive: true,
                              data: {
                                  labels: labels,
                                  datasets: [{
                                      label: 'Donations (cash)',
                                      data: data_array,
                                      backgroundColor: colors,
                                      borderColor: function (context) {
                                          let index = context.dataIndex;
                                          let value = context.dataset.data[index];
                                          return generateColor();
                                      },
                                      borderWidth: 1
                                  }]
                              }
                          });
                      }

                      // function generateColor(){
                      //     return 'hsla('+Math.floor(Math.random()*360)+',100%,70%,1)';
                      // }
                      function generateColor(){
                          let letters = '0123456789ABCDEF';
                          let color = "#";
                          for(let i=0; i<6;i++){
                              color += letters[Math.floor(Math.random() * 16)];
                          }
                          return color;
                      }
                  </script>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
