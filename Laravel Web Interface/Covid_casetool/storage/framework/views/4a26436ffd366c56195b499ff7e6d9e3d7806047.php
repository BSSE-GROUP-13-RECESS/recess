<?php $__env->startSection('content'); ?>
<div class="content-header">
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-11">
          <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">Chart Of Enrollment Figures (%)</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <label for="sel">Select year: </label><select id="sel" onchange="draw()">
              </select>
              <p id="info" hidden><?php echo e(json_encode($info)); ?></p>
              <div class="chart">
                <div id="ChartA"></div>
                <script>
                    let info = JSON.parse(document.getElementById('info').innerText);
                    let sel = document.getElementById('sel');

                    sel.innerHTML="";
                    for (let value in info){
                        sel.innerHTML += "<option value="+value+">"+value+"</option>"
                    }

                    draw();
                    function draw() {
                        document.getElementById('ChartA').innerHTML ='<canvas id="myChart" style="min-height: 400px; max-height: 80%; max-width: 100%;"></canvas>';
                        let ctx = document.getElementById('myChart');
                        var labels, data_array, myChart, data;
                        data = info[document.getElementById('sel').value];
                        labels = data.labels;
                        data_array = data.dataArray;
                        let colors = [];
                        for(let i=0;i<data_array.length;i++){
                            colors.push(generateColor());
                        }
                        myChart = new Chart(ctx, {
                            type: 'bar',
                            responsive: true,
                            data: {
                                labels: labels,
                                datasets: [{
                                    barThickness: 100,
                                    label: 'Enrollment percentage change',
                                    data: data_array,
                                    backgroundColor: colors,
                                    borderColor: function (context) {
                                        let index = context.dataIndex;
                                        let value = context.dataset.data[index];
                                        return 'blue';
                                    },
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                legend: {
                                    display: false,
                                },
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }]
                                }
                            }
                        });
                    }
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.adminLTE', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/timothy/Desktop/Covid_casetool/resources/views/enrollmentGraphs.blade.php ENDPATH**/ ?>